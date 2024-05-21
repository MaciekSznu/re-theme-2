/*global wp*/
const { InnerBlocks, PlainText } = wp.blockEditor;
const { registerBlockType } = wp.blocks;

registerBlockType( 'custom/accordion-single', {
    title: 'Accordion Single',
    parent: [ 'custom/accordion' ],
    icon: 'welcome-add-page',
    category: 'custom_blocks',
    attributes: {
        title: {
            source: 'text',
            selector: '.single-accordion__title'
        }
    },
    edit: ( { attributes, setAttributes, className } ) => {
        const customClass = 'single-accordion';

        return (
            <>
            <div className={ `${customClass} ${className}` }>
                <div className="single-accordion__header">
                    <h3 className="single-accordion__title">
                        <PlainText
                        onChange={ content => setAttributes({ title: content }) }
                        value={ attributes.title }
                        placeholder="Your Accordion title"
                        className="heading"
                        />
                        <span className="single-accordion__icon" />
                    </h3>
                </div>
                <div className="single-accordion__content">
                    <InnerBlocks />
                </div>
            </div>
            </>
        );
    },
    save: ( { attributes} ) => {
        const customClass = 'single-accordion';

        return (
            <div className={ `${customClass}` }>
                <div className="single-accordion__header">
                    <h3 className="single-accordion__title">{ attributes.title }<span className="single-accordion__icon" /></h3>
                </div>
                <div className="single-accordion__content">
                <InnerBlocks.Content />
                </div>
            </div>
        );
    },
} );