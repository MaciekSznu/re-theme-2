const { wp } = window;
const { cloneElement } = wp.element;

/**
 * It extend the block element with additional attributes.
 *
 * @param element - The block element. It could be a React component or an HTML element.
 * @param blockType - The block type object.
 * @param attributes - The attributes object for the block.
 * @returns New extended element.
 */
const extendBlockProps = (element, blockType, attributes) => {
    if (!element) {
        return {};
    }

    if (
        !blockType.name.startsWith('acf') &&
        !blockType.name.startsWith('core') &&
        !blockType.name.startsWith('custom')
    ) {
        return element;
    }

    const {
        paddingMobile,
        paddingTablet,
        paddingDesktop,
        spacingMobile,
        spacingTablet,
        spacingDesktop,
        dataId,
    } = attributes;

    const allSpacings = [
        Object.values(paddingMobile),
        Object.values(paddingTablet),
        Object.values(paddingDesktop),
        Object.values(spacingMobile),
        Object.values(spacingTablet),
        Object.values(spacingDesktop),
    ];
    const flattenedArray = [].concat(...allSpacings);

    let isEmpty = true;
    let newElement = element;

    flattenedArray.forEach((item) => {
        if (item !== '' && item !== undefined) {
            isEmpty = false;
        }
    });

    if (!isEmpty) {
        newElement = cloneElement(element, {
            'data-id': `${dataId}`,
        });
    }

    return newElement;
};

wp.hooks.addFilter(
    'blocks.getSaveElement',
    'edit-block-attributes/extend-block-props',
    extendBlockProps
);
