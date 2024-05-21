import { getValues } from './get-values';

const { wp } = window;
const { createHigherOrderComponent } = wp.compose;

/* It's a higher order component that extends BlockListBlock component */
const blockEditorWrapper = createHigherOrderComponent(
    (BlockListBlock) => {
        return (props) => {
            const { attributes, name } = props;
            if (!name.startsWith('core') && !name.startsWith('custom')) {
                return <BlockListBlock {...props} />;
            }

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
            let wrapperProps = {};
            let html = '';

            flattenedArray.forEach((element) => {
                if (element !== '' && element !== undefined) {
                    isEmpty = false;
                }
            });

            if (!isEmpty) {
                wrapperProps = {
                    'data-id': `${dataId}`,
                };

                let styleContent = '';

                if (paddingMobile || spacingMobile) {
                    styleContent += `[data-id="${dataId}"] { ${getValues(
                        paddingMobile
                    )} ${getValues(spacingMobile, 'margin')} }`;
                }

                if (paddingTablet || spacingTablet) {
                    styleContent += `@media (min-width: 768px) { [data-id="${dataId}"] { ${getValues(
                        paddingTablet
                    )} ${getValues(spacingTablet, 'margin')} } }`;
                }

                if (paddingDesktop || spacingDesktop) {
                    styleContent += `@media (min-width: 992px) { [data-id="${dataId}"] { ${getValues(
                        paddingDesktop
                    )} ${getValues(spacingDesktop, 'margin')} } }`;
                }
                html = `${styleContent}`;
            }

            return (
                <>
                    <BlockListBlock {...props} wrapperProps={wrapperProps} />
                    <style dangerouslySetInnerHTML={{ __html: html }} />
                </>
            );
        };
    },
    'blockEditorWrapper'
);

wp.hooks.addFilter(
    'editor.BlockListBlock',
    'edit-block-attributes/block-editor-wrapper',
    blockEditorWrapper
);
