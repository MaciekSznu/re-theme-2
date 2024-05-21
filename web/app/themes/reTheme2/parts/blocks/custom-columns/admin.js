/*global wp*/
const { InnerBlocks, InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;
const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;


const generateClass = (attributes, editor) => {
	const { spacingTop, spacingBottom, marginTop, marginBottom, smallGutter } = attributes;

    let customClass = 'columns-row';

    customClass += editor ? ' row--editor': ' row';

    customClass += smallGutter ? ` small-gutter` : '';

    customClass += spacingTop ? ' columns-row--spacing-top' : '';
    customClass += spacingBottom ? ' columns-row--spacing-bottom' : '';
    customClass += marginTop ? ' columns-row--margin-top' : '';
    customClass += marginBottom ? ' columns-row--margin-bottom' : '';

	return customClass;
}

registerBlockType( 'custom/columns', {
    title: 'Columns Row',
    icon: 'grid-view',
    category: 'custom_blocks',
    attributes: {
        smallGutter: {
			type: 'boolean',
			default: false
        },
		spacingTop: {
			type: 'boolean',
			default: false
        },
		spacingBottom: {
			type: 'boolean',
			default: false
        },
		marginTop: {
			type: 'boolean',
			default: false
        },
		marginBottom: {
			type: 'boolean',
			default: false
        },
    },
    edit: ( { attributes, setAttributes } ) => {
        const ALLOWED_BLOCKS = [ 'custom/column' ];
        const { spacingTop, spacingBottom, marginTop, marginBottom, smallGutter } = attributes;
        return (
            <>
			<InspectorControls>
				<PanelBody title={ __( 'Settings' ) }>
					<ToggleControl
						label={ __( 'Small Columns gutter' ) }
						checked={ !! smallGutter }
						onChange={ () =>
							setAttributes( { smallGutter: ! smallGutter } )
						}
						help={
							smallGutter
								? 'Adding smaller gutter'
								: 'Toggle to add smaller gutter.'
						}
					/>
                    <ToggleControl
                        label={ __( 'Top Spacing' ) }
                        checked={ !! spacingTop }
                        onChange={ () =>
                            setAttributes( { spacingTop: ! spacingTop } )
                        }
                        help={
                            spacingTop
                                ? 'Adding Top spacing'
                                : 'Toggle to add Top spacing.'
                        }
                    />
                    <ToggleControl
                        label={ __( 'Bottom Spacing' ) }
                        checked={ !! spacingBottom }
                        onChange={ () =>
                            setAttributes( { spacingBottom: ! spacingBottom } )
                        }
                        help={
                            spacingBottom
                                ? 'Adding Bottom spacing'
                                : 'Toggle to add Bottom spacing.'
                        }
                    />
                    <ToggleControl
                        label= { __( 'Top margin' ) }
                        checked={ !! marginTop }
                        onChange={ () =>
                            setAttributes( { marginTop: ! marginTop } )
                        }
                        help={
                            marginTop
                                ? 'Adding Top margin'
                                : 'Toggle to add Top margin.'
                        }
                    />
                    <ToggleControl
                        label={ __( 'Bottom margin' ) }
                        checked={ !! marginBottom }
                        onChange={ () =>
                            setAttributes( { marginBottom: ! marginBottom } )
                        }
                        help={
                            marginBottom
                                ? 'Adding Bottom margin'
                                : 'Toggle to add Bottom margin.'
                        }
                    />
                </PanelBody>
            </InspectorControls>
            <div className={ generateClass(attributes, true) }>
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
				/>
            </div>
            </>
        );
    },
    save: ( { attributes } ) => {
        return (
            <div className={ generateClass(attributes, false) }>
                <div data-styles-id="custom-columns" />
                <InnerBlocks.Content />
            </div>
        );
    },
    deprecated: [
        {
            save: ( { attributes } ) => {
                const { smallGutter } = attributes;
                let customClass = 'columns-row row';
                customClass += smallGutter ? ` small-gutter` : '';
                return (
                    <div className={ customClass }>
                        <InnerBlocks.Content />
                    </div>
                );
            },
        }
    ]
} );