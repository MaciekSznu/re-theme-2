/*global wp*/
const { InnerBlocks, InspectorControls, PanelColorSettings } = wp.blockEditor;
const { registerBlockType } = wp.blocks;
const { PanelBody, ToggleControl } = wp.components;
const { select } = wp.data;
const { getColorClassName, getColorObjectByColorValue } = wp.editor;
const { __ } = wp.i18n;

const generateClass = attributes => {
	const { spacingTop, spacingBottom, marginTop, marginBottom, backgroundColor } = attributes;
    let customClass = 'block-content ';
    if( backgroundColor ) {
        const settings = select( 'core/editor' ).getEditorSettings();
        const colorObject = getColorObjectByColorValue( settings.colors, backgroundColor );
        if ( colorObject ) {
            customClass += getColorClassName( 'background-color', colorObject.slug );
        }
    }

    customClass += spacingTop ? ' block-content--spacing-top' : '';
    customClass += spacingBottom ? ' block-content--spacing-bottom' : '';
    customClass += marginTop ? ' block-content--margin-top' : '';
    customClass += marginBottom ? ' block-content--margin-bottom' : '';

	return customClass;
}

const generateAttr = attributes => {
    const { backgroundColor } = attributes;
    const attrObj = {};

    if (backgroundColor) {
        attrObj.style = {};
        attrObj.style.backgroundColor = backgroundColor;
    }

    return attrObj;
}

registerBlockType( 'custom/container', {
    title: 'Container',
    icon: 'welcome-add-page',
    category: 'custom_blocks',
    supports: {
        align: [ 'wide', 'full' ],
        anchor: true,
    },
    attributes: {
        align: {
            type: 'string',
            default: 'wide'
        },
        backgroundColor: {
            type: 'string'
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
        const { spacingTop, spacingBottom, marginTop, marginBottom, backgroundColor } = attributes;;
        return (
            <>
			<InspectorControls>
				<PanelBody title={ __( 'Settings' ) }>
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
                <PanelColorSettings
                    title={ __( 'Color Settings' ) }
                    colorSettings={ [
                        {
                            value: backgroundColor,
                            onChange: ( colorValue ) => setAttributes( { backgroundColor: colorValue } ),
                            label: __( 'Background Color' ),
                        },
                    ] }
                />
			</InspectorControls>
            <section className={ generateClass(attributes) } {...generateAttr(attributes)}>
                <div className={ `container container--${attributes.align}` }>
                    <div className="container__body">
                    <InnerBlocks />
                    </div>
                </div>
            </section>
            </>
        );
    },
    save: ( { attributes } ) => {
        return (
            <section className={ generateClass(attributes) }>
                <div data-styles-id="custom-container" />
                <div className={ `container container--${ attributes.align}` }>
                    <div className="container__body">
                    <InnerBlocks.Content />
                    </div>
                </div>
            </section>
        );
    },
} );