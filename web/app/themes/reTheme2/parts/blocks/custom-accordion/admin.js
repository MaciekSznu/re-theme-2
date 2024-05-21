/*global wp*/

import { backendAccordionInit } from './index';

const { InnerBlocks, PlainText } = wp.blockEditor;
const { registerBlockType } = wp.blocks;

backendAccordionInit();

registerBlockType( 'custom/accordion', {
    title: 'Accordion Wrapper',
    icon: 'welcome-add-page',
    category: 'custom_blocks',
    attributes: {
        title: {
            source: 'text',
            selector: '.section-heading'
        }
    },
    edit: ( { attributes, className, setAttributes } ) => {

        const customClass = 'block-accordion';
        const ALLOWED_BLOCKS = [ 'custom/accordion-single' ];

        return (
            <>
            <div className={ `${customClass} ${className}` }>
                <h2 className="section-heading is-style-underline">
                    <PlainText
                    onChange={ content => setAttributes({ title: content }) }
                    value={ attributes.title }
                    placeholder="Your Accordion title"
                    className="heading"
                    />
                </h2>
                    <div className={ `${customClass}__body` }>
                    <InnerBlocks
                        allowedBlocks={ ALLOWED_BLOCKS }
                    />
                    </div>
            </div>
            </>
        );
    },
    save: ( { attributes } ) => {
        const customClass = 'block-accordion';

        return (
            <div className={ `${customClass}` }>
                <div data-styles-id="custom-accordion" />
                <h2 className="section-heading is-style-underline">{ attributes.title }</h2>
                    <div className={ `${customClass}__body` }>
                    <InnerBlocks.Content />
                    </div>
            </div>
        );
    },
} );