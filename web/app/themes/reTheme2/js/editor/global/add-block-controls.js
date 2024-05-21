const { wp } = window;
const { __ } = wp.i18n;
const { createHigherOrderComponent } = wp.compose;
const { Fragment, useEffect } = wp.element;
const { InspectorControls, InspectorAdvancedControls } = wp.blockEditor;
const { PanelBody, __experimentalBoxControl } = wp.components;
const { TextControl } = wp.components;

/* It's a higher order component that adds a additional functionality to blocks */
const blockControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { attributes, name, clientId } = props;
        const {
            paddingMobile,
            paddingTablet,
            paddingDesktop,
            spacingMobile,
            spacingTablet,
            spacingDesktop,
            anchorLabel,
            dataId,
        } = attributes;

        if (
            !name.startsWith('acf') &&
            !name.startsWith('core') &&
            !name.startsWith('custom')
        ) {
            return <BlockEdit {...props} />;
        }

        useEffect(() => {
            if (dataId === undefined || dataId === '') {
                props.setAttributes({
                    dataId: clientId,
                });
            }
        }, [dataId, clientId, props]);

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Padding', 'edit-block-attributes')}
                        initialOpen={false}
                    >
                        <p>
                            {__(
                                'Overrides default block paddings in px.',
                                'edit-block-attributes'
                            )}
                        </p>
                        {
                            <__experimentalBoxControl
                                label="Mobile"
                                values={paddingMobile}
                                units="px"
                                onChange={(values) =>
                                    props.setAttributes({
                                        paddingMobile: values,
                                    })
                                }
                            />
                        }
                        {
                            <__experimentalBoxControl
                                label="Tablet"
                                values={paddingTablet}
                                units="px"
                                onChange={(values) =>
                                    props.setAttributes({
                                        paddingTablet: values,
                                    })
                                }
                            />
                        }
                        {
                            <__experimentalBoxControl
                                label="Desktop"
                                values={paddingDesktop}
                                units="px"
                                onChange={(values) =>
                                    props.setAttributes({
                                        paddingDesktop: values,
                                    })
                                }
                            />
                        }
                    </PanelBody>
                    <PanelBody
                        title={__('Spacing', 'edit-block-attributes')}
                        initialOpen={false}
                    >
                        <p>
                            {__(
                                'Overrides default block spacings in px.',
                                'edit-block-attributes'
                            )}
                        </p>
                        <__experimentalBoxControl
                            label="Mobile"
                            values={spacingMobile}
                            units="px"
                            sides={['top', 'bottom']}
                            inputProps={{ min: -9999 }}
                            onChange={(values) =>
                                props.setAttributes({ spacingMobile: values })
                            }
                        />
                        <__experimentalBoxControl
                            label="Tablet"
                            values={spacingTablet}
                            units="px"
                            sides={['top', 'bottom']}
                            inputProps={{ min: -9999 }}
                            onChange={(values) =>
                                props.setAttributes({ spacingTablet: values })
                            }
                        />
                        <__experimentalBoxControl
                            label="Desktop"
                            values={spacingDesktop}
                            units="px"
                            sides={['top', 'bottom']}
                            inputProps={{ min: -9999 }}
                            onChange={(values) =>
                                props.setAttributes({
                                    spacingDesktop: values,
                                })
                            }
                        />
                    </PanelBody>
                </InspectorControls>
                <InspectorAdvancedControls>
                    <TextControl
                        label="HTML Anchor Label"
                        value={anchorLabel}
                        onChange={(value) =>
                            props.setAttributes({ anchorLabel: value })
                        }
                        help="Extension of the 'HTML Anchor' field - label that will be displayed in the inpage nav (if left empty, the label will be created based on the value in the 'HTML Anchor' field)"
                    />
                </InspectorAdvancedControls>
            </Fragment>
        );
    };
}, 'blockControls');

wp.hooks.addFilter(
	'editor.BlockEdit',
	'edit-block-attributes/block-controls',
	blockControls
);
