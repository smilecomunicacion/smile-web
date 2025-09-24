(function (window, wp) {
        'use strict';

        if (!wp || !wp.plugins || !wp.components || !wp.data || !wp.element || !wp.apiFetch || !wp.i18n) {
                return;
        }

        var panelData = window.smileV6IntroImagePanel || {};
        var metaKey = panelData.metaKey || 'smile_v6_intro_image_id';
        var strings = panelData.strings || {};

        var registerPlugin = wp.plugins.registerPlugin;
        var Button = wp.components.Button;
        var Spinner = wp.components.Spinner;
        var useSelect = wp.data.useSelect;
        var useDispatch = wp.data.useDispatch;
        var createElement = wp.element.createElement;
        var useState = wp.element.useState;
        var useEffect = wp.element.useEffect;
        var MediaUpload = (wp.blockEditor && wp.blockEditor.MediaUpload) || (wp.editor && wp.editor.MediaUpload);
        var MediaUploadCheck = (wp.blockEditor && wp.blockEditor.MediaUploadCheck) || (wp.editor && wp.editor.MediaUploadCheck);
        var __ = wp.i18n.__;

        if (!registerPlugin || !MediaUpload || !MediaUploadCheck) {
                return;
        }

        var defaultStrings = {
                panelTitle: __('Intro image', 'smile-web'),
                panelDescription: __('Select an image to replace the intro highlight. It behaves like the custom header artwork.', 'smile-web'),
                selectImageButton: __('Choose intro image', 'smile-web'),
                replaceImageButton: __('Replace intro image', 'smile-web'),
                clearImageButton: __('Remove intro image', 'smile-web'),
                placeholderText: __('No intro image selected yet.', 'smile-web'),
                previewLabel: __('Intro image preview', 'smile-web')
        };

        function getString(key) {
                if (strings && strings[key]) {
                        return strings[key];
                }

                return defaultStrings[key];
        }

        var hasRegistered = false;
        var MAX_ATTEMPTS = 10;
        var RETRY_DELAY = 50;

        function registerIntroImagePanel(PluginDocumentSettingPanel) {
                if (hasRegistered || !PluginDocumentSettingPanel) {
                        return;
                }

                hasRegistered = true;

                function IntroImagePanel() {
                        var postType = useSelect(function (select) {
                                return select('core/editor').getCurrentPostType();
                        }, []);

                        var introImageId = useSelect(function (select) {
                                var meta = select('core/editor').getEditedPostAttribute('meta') || {};
                                var value = meta[metaKey];

                                return value ? parseInt(value, 10) : 0;
                        }, []);

                        var editPost = useDispatch('core/editor').editPost;

                        var setMeta = function (value) {
                                var newValue = {};
                                newValue[metaKey] = value;
                                editPost({ meta: newValue });
                        };

                        var mediaState = useState(null);
                        var mediaDetails = mediaState[0];
                        var setMediaDetails = mediaState[1];
                        var loadingState = useState(false);
                        var isLoading = loadingState[0];
                        var setIsLoading = loadingState[1];

                        useEffect(function () {
                                var isSubscribed = true;

                                if (!introImageId) {
                                        setMediaDetails(null);
                                        setIsLoading(false);

                                        return function () {
                                                isSubscribed = false;
                                        };
                                }

                                setIsLoading(true);

                                wp.apiFetch({ path: '/wp/v2/media/' + introImageId + '?context=edit' }).then(function (response) {
                                        if (!isSubscribed) {
                                                return;
                                        }

                                        setMediaDetails(response || null);
                                        setIsLoading(false);
                                }).catch(function () {
                                        if (!isSubscribed) {
                                                return;
                                        }

                                        setMediaDetails(null);
                                        setIsLoading(false);
                                });

                                return function () {
                                        isSubscribed = false;
                                };
                        }, [introImageId]);

                        if (['post', 'page'].indexOf(postType) === -1) {
                                return null;
                        }

                        var previewUrl = '';
                        var previewAlt = '';

                        if (mediaDetails) {
                                if (mediaDetails.media_details && mediaDetails.media_details.sizes) {
                                        if (mediaDetails.media_details.sizes.large && mediaDetails.media_details.sizes.large.source_url) {
                                                previewUrl = mediaDetails.media_details.sizes.large.source_url;
                                        } else if (mediaDetails.media_details.sizes.medium_large && mediaDetails.media_details.sizes.medium_large.source_url) {
                                                previewUrl = mediaDetails.media_details.sizes.medium_large.source_url;
                                        } else if (mediaDetails.media_details.sizes.full && mediaDetails.media_details.sizes.full.source_url) {
                                                previewUrl = mediaDetails.media_details.sizes.full.source_url;
                                        }
                                }

                                if (!previewUrl && mediaDetails.source_url) {
                                        previewUrl = mediaDetails.source_url;
                                }

                                if (mediaDetails.alt_text) {
                                        previewAlt = mediaDetails.alt_text;
                                }
                        }

                        return createElement(
                                PluginDocumentSettingPanel,
                                {
                                        name: 'smile-v6-intro-image-panel',
                                        title: getString('panelTitle'),
                                        className: 'smile-v6-intro-image-panel'
                                },
                                createElement(
                                        'p',
                                        { className: 'smile-v6-intro-image-panel__description' },
                                        getString('panelDescription')
                                ),
                                createElement(
                                        MediaUploadCheck,
                                        null,
                                        createElement(MediaUpload, {
                                                onSelect: function (media) {
                                                        if (media && media.id) {
                                                                setMeta(parseInt(media.id, 10));
                                                        }
                                                },
                                                value: introImageId,
                                                allowedTypes: ['image'],
                                                render: function (props) {
                                                        return createElement(
                                                                Button,
                                                                {
                                                                        onClick: props.open,
                                                                        className: 'smile-v6-intro-image-panel__select',
                                                                        icon: 'format-image',
                                                                        isPrimary: !introImageId,
                                                                        isSecondary: !!introImageId
                                                                },
                                                                introImageId ? getString('replaceImageButton') : getString('selectImageButton')
                                                        );
                                                }
                                        })
                                ),
                                introImageId ? createElement(
                                        Button,
                                        {
                                                onClick: function () {
                                                        setMeta(0);
                                                },
                                                className: 'smile-v6-intro-image-panel__clear',
                                                isLink: true
                                        },
                                        getString('clearImageButton')
                                ) : null,
                                createElement(
                                        'div',
                                        {
                                                className: 'smile-v6-intro-image-panel__preview',
                                                role: 'group',
                                                'aria-label': getString('previewLabel')
                                        },
                                        isLoading ? createElement(Spinner, null) : previewUrl ?
                                                createElement(
                                                        'figure',
                                                        { className: 'smile-v6-intro-image-panel__figure' },
                                                        createElement('img', { src: previewUrl, alt: previewAlt })
                                                ) :
                                                createElement(
                                                        'p',
                                                        { className: 'smile-v6-intro-image-panel__placeholder' },
                                                        getString('placeholderText')
                                                )
                                )
                        );
                }

                registerPlugin('smile-v6-intro-image', {
                        render: IntroImagePanel
                });
        }

        function attemptRegistration(remainingAttempts) {
                if (hasRegistered) {
                        return;
                }

                var pluginPanel = wp.editor && wp.editor.PluginDocumentSettingPanel;

                if (!pluginPanel && remainingAttempts > 0) {
                        window.setTimeout(function () {
                                attemptRegistration(remainingAttempts - 1);
                        }, RETRY_DELAY);

                        return;
                }

                if (!pluginPanel && wp.editPost && wp.editPost.PluginDocumentSettingPanel) {
                        pluginPanel = wp.editPost.PluginDocumentSettingPanel;
                }

                if (!pluginPanel) {
                        return;
                }

                registerIntroImagePanel(pluginPanel);
        }

        attemptRegistration(MAX_ATTEMPTS);
}(window, window.wp));
