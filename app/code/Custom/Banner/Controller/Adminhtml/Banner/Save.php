<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Save Banner action.
 */

class Save extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();

        if ($data = $this->getRequest()->getPostValue()) {
	    $model = $this->_bannerFactory->create();
            $storeViewId = $this->getRequest()->getParam('store');

            if ($id = $this->getRequest()->getParam('id')) {
                $model->load($id);
            }

            try {
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$upload = $objectManager->get('Magento\MediaStorage\Model\File\UploaderFactory');
		$filesystem = $objectManager->create('Magento\Framework\Filesystem');
		$imageAdapter = $objectManager->get('Magento\Framework\Image\AdapterFactory');
		    
		if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
		    
		    /*
		    * Save image upload
		    */
		    try {
			
			$base_media_path = 'banner/';
			$upload = $upload->create(
			['fileId' => 'image']
			);
			$upload->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
			$upload->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
			$upload->setAllowRenameFiles(true);
			$upload->setFilesDispersion(false);
			$mediaDirectory = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
			$result = $upload->save(
			//$mediaDirectory->getAbsolutePath()
			$mediaDirectory->getAbsolutePath($base_media_path)
			);
			
			$data['image'] = $result['file'];
			
		    }catch (\Exception $e) {
			if ($e->getCode() == 0) {
			    $this->messageManager->addError($e->getMessage());
			}
		    }
		}else {
		    if (isset($data['image']) && isset($data['image']['value'])) {
			//$data['image']['value'];
			$image_val = str_replace("banner/","",$data['image']['value']);
			
			if (isset($data['image']['delete'])) {
			   $mediaDirectory = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
			   
			    $pathToFile = $mediaDirectory->getAbsolutePath().$data['image']['value'];
			    if (file_exists($pathToFile)) // if file exists
				unlink($pathToFile); 
		    
			    $data['image'] = '';
			    $data['delete_image'] = true;
			} elseif (isset($image_val)) {
			    $data['image'] = $image_val;
			} else {
			    $data['image'] = null;
			}
		    }
		}
		
		$model->setData($data)
                  ->setStoreViewId($storeViewId);
                $model->save();

                $this->messageManager->addSuccess(__('The banner has been saved.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back') === 'edit') {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        [
                            'id' => $model->getId(),
                            '_current' => true,
                            'store' => $storeViewId,
                            'saveandclose' => $this->getRequest()->getParam('saveandclose'),
                        ]
                    );
                } elseif ($this->getRequest()->getParam('back') === 'new') {
                    return $resultRedirect->setPath(
                        '*/*/new',
                        ['_current' => TRUE]
                    );
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the banner.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
