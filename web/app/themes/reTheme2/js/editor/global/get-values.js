/**
 * The function `getValues` returns a string of CSS style content based on the provided values and
 * type.
 * @param values - An object containing CSS property names and their corresponding values.
 * @param [type=padding] - The `type` parameter is a string that specifies the CSS property type. In
 * the given code, the default value for `type` is set to `'padding'`.
 * @returns a string containing CSS style content.
 */

export const getValues = (values, type = 'padding') => {
    if (values && Object.keys(values).length > 0) {
        let styleContent = '';
        Object.keys(values).forEach((name) => {
            if (values[name]) {
                styleContent += `${type}-${name}: ${values[name]} !important;`;
            }
        });
        return styleContent;
    }
    return '';
};
