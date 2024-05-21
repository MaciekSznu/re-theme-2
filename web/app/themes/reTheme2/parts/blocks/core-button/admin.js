/* eslint-disable no-param-reassign */
const { wp } = window;
const { __ } = wp.i18n;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, ComboboxControl, SelectControl, ToggleControl } =
    wp.components;

const iconArray = [];
const BLOCK_NAME = 'core/button';

/* Getting the icons from the style-iconfont.css file and adding them to the iconArray. */
(() => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${window.iconpicker.stylesheetUrl}/css/style-iconfont.css`, true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 0 || (xhr.status >= 200 && xhr.status < 400)) {
                const regExpLabels = /\.(?:-?icon(?:-[a-z0-9]+)*)/g;
                const regExpContents = /(?<=content:")(.*?)(?=\s*")/gm;

                const items = xhr.responseText.match(regExpLabels);
                const itemsContents = xhr.responseText.match(regExpContents);

                items.map((icon, index) => {
                    iconArray[index] = {
                        label: icon.replace(/\./g, ''),
                        value: `"${itemsContents[index]}"`,
                    };
                    return iconArray;
                });
            } else {
                console.error('There was an error with sync icons!');
            }
        }
    };
    xhr.send();
})();

/**
 * If the block is a button, add the new attributes to the block settings
 *
 * @param { Object } settings - The settings object for the block.
 * @param { string } name     - The name of the block.
 * @return { Object } The settings object is being returned.
 */
const blockButtonAttributes = (settings, name) => {
    if (typeof settings.attributes !== 'undefined' && name === BLOCK_NAME) {
        settings = Object.assign(
            settings,
            {
                styles: [],
            },
            {
                attributes: Object.assign(settings.attributes, {
                    variant: {
                        type: 'string',
                        default: 'primary',
                    },
                    color: {
                        type: 'string',
                        default: 'normal',
                    },
                    buttonIcon: {
                        type: 'object',
                        default: {
                            displayIcon: false,
                            iconPosition: 'left',
                            icon: '',
                        },
                    },
                }),
            }
        );
    }

    return settings;
};

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'edit-block-attributes/block-button',
    blockButtonAttributes
);

/* It's a higher order component that adds a select variant control to the block editor. */
const variantControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { attributes, setAttributes, name } = props;
        const { variant, color } = attributes;

        if (name !== BLOCK_NAME) {
            return <BlockEdit {...props} />;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Button Variant', 'edit-block-attributes')}
                        initialOpen={false}
                    >
                        <SelectControl
                            label={__('Variant', 'edit-block-attributes')}
                            value={variant}
                            options={[
                                {
                                    value: null,
                                    label: __(
                                        'Select a button variant',
                                        'edit-block-attributes'
                                    ),
                                    disabled: true,
                                },
                                {
                                    label: __(
                                        'Primary',
                                        'edit-block-attributes'
                                    ),
                                    value: 'primary',
                                },
                                {
                                    label: __(
                                        'Secondary',
                                        'edit-block-attributes'
                                    ),
                                    value: 'secondary',
                                },
                                {
                                    label: __(
                                        'Tertiary',
                                        'edit-block-attributes'
                                    ),
                                    value: 'tertiary',
                                },
                            ]}
                            onChange={(value) => {
                                setAttributes({ variant: value });
                            }}
                        />
                        <SelectControl
                            label={__('Color', 'edit-block-attributes')}
                            value={color}
                            options={[
                                {
                                    value: null,
                                    label: __(
                                        'Select a button color',
                                        'edit-block-attributes'
                                    ),
                                    disabled: true,
                                },
                                {
                                    label: __(
                                        'Normal',
                                        'edit-block-attributes'
                                    ),
                                    value: 'normal',
                                },
                                {
                                    label: __(
                                        'Alternative',
                                        'edit-block-attributes'
                                    ),
                                    value: 'alt',
                                },
                            ]}
                            onChange={(value) => {
                                setAttributes({ color: value });
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'variantControl');

wp.hooks.addFilter(
    'editor.BlockEdit',
    'edit-block-attributes/variant-control',
    variantControl
);

/* It's a higher order component that adds a button icon options to the block editor. */
const buttonBlockEditorWrapper = createHigherOrderComponent(
    (BlockListBlock) => {
        return (props) => {
            const { attributes, name } = props;
            if (BLOCK_NAME !== name) {
                return <BlockListBlock {...props} />;
            }

            const { variant, color, buttonIcon } = attributes;

            let buttonVariant = 'wp-block-button--primary';
            let buttonColor = 'wp-block-button--color-normal';

            if (variant) {
                buttonVariant = `wp-block-button--${variant}`;
            }

            if (color) {
                buttonColor = `wp-block-button--color-${color}`;
            }

            let buttonClass = `${buttonVariant} ${buttonColor}`;

            if (buttonIcon.displayIcon) {
                buttonClass += ' wp-block-button--icon';
                if (buttonIcon.iconPosition) {
                    buttonClass += ` wp-block-button--icon-align-${buttonIcon.iconPosition}`;
                }

                return (
                    <BlockListBlock
                        {...props}
                        className={buttonClass}
                        wrapperProps={{
                            style: {
                                '--buttonIcon': `${buttonIcon.icon}`,
                            },
                        }}
                    />
                );
            }
            return <BlockListBlock {...props} className={buttonClass} />;
        };
    },
    'buttonBlockEditorWrapper'
);
wp.hooks.addFilter(
    'editor.BlockListBlock',
    'edit-block-attributes/button-block-editor-wrapper',
    buttonBlockEditorWrapper
);

/* It's a higher order component that adds a button icon options to the block editor. */
const buttonIconOptions = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { attributes, setAttributes, name } = props;
        const { buttonIcon } = attributes;
        if (name !== BLOCK_NAME) {
            return <BlockEdit {...props} />;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Icon Options', 'edit-block-attributes')}
                        initialOpen={false}
                    >
                        <ToggleControl
                            label="Display Icon"
                            checked={buttonIcon.displayIcon}
                            onChange={() => {
                                setAttributes({
                                    buttonIcon: {
                                        ...buttonIcon,
                                        displayIcon: !buttonIcon.displayIcon,
                                    },
                                });
                            }}
                        />
                        <SelectControl
                            label={__('Icon Position', 'edit-block-attributes')}
                            value={buttonIcon.iconPosition}
                            options={[
                                {
                                    value: null,
                                    label: __(
                                        'Select a icon position',
                                        'edit-block-attributes'
                                    ),
                                    disabled: true,
                                },
                                {
                                    label: __('Left', 'edit-block-attributes'),
                                    value: 'left',
                                },
                                {
                                    label: __('Right', 'edit-block-attributes'),
                                    value: 'right',
                                },
                            ]}
                            onChange={(value) => {
                                const newButtonIcon = { ...buttonIcon };
                                newButtonIcon.iconPosition = value;

                                setAttributes({
                                    buttonIcon: { ...newButtonIcon },
                                });
                            }}
                        />
                        <ComboboxControl
                            label={__('Icon', 'edit-block-attributes')}
                            value={buttonIcon.icon}
                            options={iconArray}
                            onChange={(value) => {
                                const newButtonIcon = { ...buttonIcon };
                                newButtonIcon.icon = value;
                                setAttributes({
                                    buttonIcon: { ...newButtonIcon },
                                });
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'buttonIconOptions');

wp.hooks.addFilter(
    'editor.BlockEdit',
    'edit-block-attributes/variant-control',
    buttonIconOptions
);

/**
 * It adds a class to the button block's wrapper element based on the block's attributes
 * @param props - The props that are passed to the block's save function.
 * @param blockType - The block type object.
 * @param attributes - The attributes object for the block.
 * @returns The props object is being returned.
 */
const saveButton = (props, blockType, attributes) => {
    if (blockType.name === BLOCK_NAME) {
        const { variant, color, buttonIcon } = attributes;

        let buttonVariant = 'wp-block-button--primary';
        let buttonColor = 'wp-block-button--color-normal';

        if (variant) {
            buttonVariant = `wp-block-button--${variant}`;
        }

        if (color) {
            buttonColor = `wp-block-button--color-${color}`;
        }

        props.className += ` ${buttonVariant} ${buttonColor}`;

        if (buttonIcon.displayIcon) {
            if (!props.style) {
                props.style = {};
            }
            props.className += ' wp-block-button--icon';

            if (buttonIcon.iconPosition) {
                props.className += ` wp-block-button--icon-align-${buttonIcon.iconPosition}`;
            }

            props.style['--buttonIcon'] = `${buttonIcon.icon}`;
        }
    }

    return props;
};
wp.hooks.addFilter(
    'blocks.getSaveContent.extraProps',
    'edit-block-attributes/save-button-block-props',
    saveButton
);
/* eslint-enable no-param-reassign */
