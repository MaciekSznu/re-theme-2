/**
 * It adds the custom attributes to all blocks
 *
 * @param { Object } settings - The settings object for the block.
 * @param { string } name     - The name of the block.
 * @return { Object } The settings object with the new attributes added.
 */
const addAttributes = (settings, name) => {
    let { attributes } = settings;
    if (
        typeof attributes !== 'undefined' &&
        (name.startsWith('acf') ||
            name.startsWith('core') ||
            name.startsWith('custom'))
    ) {
        attributes = Object.assign(settings.attributes, {
            paddingMobile: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            paddingTablet: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            paddingDesktop: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            spacingMobile: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            spacingTablet: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            spacingDesktop: {
                type: 'object',
                default: { top: '', left: '', right: '', bottom: '' },
            },
            anchorLabel: {
                type: 'string',
                default: '',
            },
            dataId: {
                type: 'string',
                default: '',
            },
        });
    }

    return settings;
};

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'edit-block-attributes/custom-attributes',
    addAttributes
);
