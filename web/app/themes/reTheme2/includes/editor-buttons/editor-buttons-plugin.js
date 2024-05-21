/* eslint-disable */
(function ($) {
    let itemsArray = [];
    const url = `${window.iconpicker.stylesheetUrl}/css/style-iconfont.css`;

    function returnItems() {
        $.get(url, function (resp) {
            const regExp = /\.(?:-?icon(?:-[a-z0-9]+)*)/g;
            const items = resp.match(regExp);
            items.forEach((item) => {
                const el = item.replace(/\./g, '');
                itemsArray.push({
                    text: el,
                    value: el,
                });
            });
            itemsArray.unshift({
                text: '',
                value: '',
            });
        });

        return itemsArray;
    }
    itemsArray = returnItems();
    tinymce.create('tinymce.plugins.default_theme', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function (ed, url) {
            // Elements button
            ed.addButton('elements', {
                text: 'Elements',
                title: 'Page Elements Shortcodes',
                type: 'menubutton',
                menu: [
                    {
                        text: 'Current Year',
                        onClick: function () {
                            ed.insertContent('[current_year]');
                        },
                    },
                    {
                        text: 'Button',
                        onClick: function () {
                            ed.windowManager.open({
                                title: 'Button Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'btnUrl',
                                        label: 'Button URL: ',
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'style',
                                        label: 'Style: ',
                                        values: [
                                            {
                                                text: 'Primary',
                                                value: 'primary',
                                            },
                                            {
                                                text: 'Secondary',
                                                value: 'secondary',
                                            },
                                            {
                                                text: 'Tertiary',
                                                value: 'tertiary',
                                            },
                                        ],
                                        value: 'primary',
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'color',
                                        label: 'Color: ',
                                        values: [
                                            { text: 'Normal', value: 'normal' },
                                            {
                                                text: 'Alternative',
                                                value: 'alt',
                                            },
                                        ],
                                        value: 'normal',
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'btnTarget',
                                        label: 'Open in: ',
                                        values: [
                                            {
                                                text: 'New Window',
                                                value: '_blank',
                                            },
                                            {
                                                text: 'Same Window',
                                                value: '_self',
                                            },
                                        ],
                                        value: 'false',
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'icon',
                                        label: 'Icon: ',
                                        values: itemsArray,
                                        value: '',
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'iconalign',
                                        label: 'Icon Align: ',
                                        values: [
                                            { text: 'Left', value: 'left' },
                                            { text: 'Right', value: 'right' },
                                        ],
                                        value: 'right',
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'title',
                                        label: 'Title: ',
                                    },
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent(
                                        '[button iconalign="' +
                                            e.data.iconalign +
                                            '" icon="' +
                                            e.data.icon +
                                            '" href="' +
                                            e.data.btnUrl +
                                            '" target="' +
                                            e.data.btnTarget +
                                            '" style="' +
                                            e.data.style +
                                            '" color="' +
                                            e.data.color +
                                            '" title="' +
                                            e.data.title +
                                            '"]' +
                                            ed.selection.getContent() +
                                            '[/button]'
                                    );
                                },
                            });
                        },
                    },
                    {
                        text: 'Group Buttons',
                        onclick: function () {
                            ed.windowManager.open({
                                title: 'Group Button Settings',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'align',
                                        label: 'Align: ',
                                        values: [
                                            { text: 'Left', value: 'left' },
                                            { text: 'Center', value: 'center' },
                                            { text: 'Right', value: 'right' },
                                        ],
                                        value: 'left',
                                    },
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent(
                                        '[group_buttons align="' +
                                            e.data.align +
                                            '"]' +
                                            ed.selection.getContent() +
                                            '[/group_buttons]'
                                    );
                                },
                            });
                        },
                    },
                    {
                        text: 'Blockquote',
                        onClick: function () {
                            ed.windowManager.open({
                                title: 'Blockquote Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'author',
                                        label: 'Author: ',
                                    },
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent(
                                        '[blockquote author="' +
                                            e.data.author +
                                            '"]' +
                                            ed.selection.getContent() +
                                            '[/blockquote]'
                                    );
                                },
                            });
                        },
                    },
                    {
                        text: 'Scroll Hook',
                        onClick: function () {
                            ed.windowManager.open({
                                title: 'Scroll Hook Settings',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'id',
                                        label: 'ID: ',
                                    },
                                ],
                                onsubmit: function (e) {
                                    ed.insertContent(
                                        '[hook id="' + e.data.id + '"]'
                                    );
                                },
                            });
                        },
                    },
                ],
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl: function (n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function () {
            return {
                longname: 'Default Theme Editor Buttons',
                author: 'Default Theme',
            };
        },
    });

    // Register plugin
    tinymce.PluginManager.add('default_theme', tinymce.plugins.default_theme);
})(jQuery);
/* eslint-enable */
