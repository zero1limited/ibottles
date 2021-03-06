define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('amasty_banners.BannersInjector', {
        options: {
            container: null,
            after: null,
            wrapper: null,
            wrappers: [],
            element: null,
            wrapperHtml: '',
            subContainerHtml: null,
            subContainer: null,
            initialized: false,
            afterProductRow: 0
        },

        _create: function () {
            this.options.initialized = $(this.options.containerSelector).length > 0;

            if (!this.options.initialized) {
                console.warn(
                    'Failed to initialize banner: Can\'t find an element with selector "' + containerSelector + '"'
                );

                return;
            }

            this.options.container = $(this.options.containerSelector)[0];
            if (this.options.afterProductNum == -1) {
                this.options.after = $(this.options.itemSelector)[0];
            } else {
                this.options.after = $(this.options.itemSelector)[this.options.afterProductNum];
            }

            if (this.options.after) {
                var wrapperCopy = $(this.options.after).clone();

                wrapperCopy.get(0).innerHTML = '';
                this.options.wrapperHtml = wrapperCopy.get(0).outerHTML;
            } else {
                this.options.wrapperHtml = '<li class="item last"></li>';
            }

            var screenWidth = window.innerWidth;
            var number = screenWidth / $(this.options.itemSelector).width();
            if (number > this.options.width) {
                this.width = this.options.width;
            } else {
                this.width = parseInt(number);
            }
        },

        inject: function (element) {
            if (!this.options.initialized) {
                return;
            }

            this.options.wrappers = [];
            this.options.element = element;
            $(element).hide();
            $(element).addClass('ambanners-injected-banner');
            for (var i = 0; i < this.width; i++) {
                var wrapper = $('<div>');
                wrapper.append(this.options.wrapperHtml);
                var insert = wrapper.children().get(0);
                insert.id = this.guid();
                this.options.wrappers.push(insert);
            }
            $(window).on('resize', this.resize.bind(this));

            this.resize();
        },

        guid: function () {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }

            return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
                s4() + '-' + s4() + s4() + s4();
        },

        insertWrapper: function (insert) {
            $(insert).addClass('ambanners-injected');

            if (this.options.after) {
                if (this.options.afterProductNum == -1) {
                    $(insert).insertBefore(this.options.after);
                } else {
                    $(insert).insertAfter(this.options.after);
                }
            } else if (this.options.container) {
                if (parseInt(this.options.afterProductRow) > 1) {
                    $(this.options.container).append(insert);
                } else {
                    $(this.options.container).prepend(insert);
                }
            }
        },

        top: function () {
            var top = 0,
                self = this;
            if (this.options.wrappers.length > 0) {
                var tops = {},
                    max = 0;

                $(this.options.wrappers).each(function (index, wrapper) {
                    var wrapperElement = $('#' + wrapper.id);

                    if (wrapperElement.length) {
                        if (tops[wrapperElement.offset().top]) {
                            tops[wrapperElement.offset().top]++;
                        } else {
                            tops[wrapperElement.offset().top] = 1;
                        }
                    }
                });

                this.tops = tops;
                Object.keys(tops).map(function(key, index) {
                    if (this.tops[key] > max) {
                        top = key;
                        max = self.tops[key];
                    }
                }.bind(this));
            }

            return top;
        },

        resize: function () {
            $(this.options.element).hide();
            if (this.options.wrappers.length > 0) {
                $(this.options.wrappers).each(function (index, wrapper) {
                    if (!$('#' + wrapper.id).length) {
                        this.insertWrapper(wrapper);
                    }
                }.bind(this));

                var top = this.top();

                $(this.options.wrappers).each(function (index, wrapper) {
                    if ($(wrapper).offset().top != top) {
                        $(wrapper).remove();
                    }
                });

                this.showBanner();
            }
        },

        showBanner: function () {
            var width = 0,
                insertWrapper,
                left = 1000,
                screenWidth = window.innerWidth;

            $(this.options.wrappers).each(function (index, wrapper) {
                if ($('#' + wrapper.id).length) {
                    width += $(wrapper).width();

                    if ($(wrapper).offset().left < left) {
                        left = $(wrapper).offset().left;
                        insertWrapper = wrapper;
                    }
                }
            });

            if (insertWrapper) {
                $(insertWrapper).append(this.options.element);
                if (width < screenWidth) {
                    $(this.options.element).css({
                        'position': 'absolute',
                        'width': width + 'px'
                    });
                } else {
                    $(this.options.element).css({
                        'position': 'absolute',
                        'width': 100 + '%'
                    });
                }

                $(insertWrapper).css({
                    'min-height': $(this.options.element).height() + 'px'
                })
            }
            $(this.options.element).show();
        }
    });

    return $.amasty_banners.BannersInjector;
});
