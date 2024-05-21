/*global wp*/
const { __ } = wp.i18n;
const {registerBlockStyle} = wp.blocks;

const styles = [
    {
        name: 'uppercase',
        label: __('Uppercase', 'reTheme2')
    },
    {
        name: 'subheading',
        label: __('Subheading', 'reTheme2')
    },
    {
        name: 'leadparagraph',
        label: __('Leadparagraph', 'reTheme2')
    },
];

wp.domReady(() => {
    styles.forEach(style => {
        registerBlockStyle('core/paragraph', style);
    });
});