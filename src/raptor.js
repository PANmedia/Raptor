/**
 * @class
 */
var Raptor =  {

    globalDefaults: {},
    defaults: {},
            
    /** @type {Boolean} True to enable hotkeys */
    enableHotkeys: true,

    /** @type {Object} Custom hotkeys */
    hotkeys: {},

    /**
     * Events added via Raptor.bind
     * @property {Object} events
     */
    events: {},

    /**
     * Plugins added via Raptor.registerPlugin
     * @property {Object} plugins
     */
    plugins: {},

    /**
     * UI added via Raptor.registerUi
     * @property {Object} ui
     */
    ui: {},

    /**
     * Layouts added via Raptor.registerLayout
     * @property {Object} layouts
     */
    layouts: {},

    /**
     * Presets added via Raptor.registerPreset
     * @property {Object} presets
     */
    presets: {},

    hoverPanels: {},

    /**
     * @property {Raptor[]} instances
     */
    instances: [],

    /**
     * @returns {Raptor[]}
     */
    getInstances: function() {
        return this.instances;
    },

    eachInstance: function(callback) {
        for (var i = 0; i < this.instances.length; i++) {
            callback.call(this.instances[i], this.instances[i]);
        }
    },

    /*========================================================================*\
     * Templates
    \*========================================================================*/
    /**
     * @property {String} urlPrefix
     */
    urlPrefix: '/raptor/',

    /**
     * @param {String} name
     * @returns {String}
     */
    getTemplate: function(name, urlPrefix) {
        var template;
        if (!this.templates[name]) {
            // Parse the URL
            var url = urlPrefix || this.urlPrefix;
            var split = name.split('.');
            if (split.length === 1) {
                // URL is for and editor core template
                url += 'templates/' + split[0] + '.html';
            } else {
                // URL is for a plugin template
                url += 'plugins/' + split[0] + '/templates/' + split.splice(1).join('/') + '.html';
            }

            // Request the template
            $.ajax({
                url: url,
                type: 'GET',
                async: false,
                // <debug>
                cache: false,
                // </debug>
                // 15 seconds
                timeout: 15000,
                error: function() {
                    template = null;
                },
                success: function(data) {
                    template = data;
                }
            });
            // Cache the template
            this.templates[name] = template;
        } else {
            template = this.templates[name];
        }
        return template;
    },

    /*========================================================================*\
     * Helpers
    \*========================================================================*/

    /**
     * @returns {boolean}
     */
    isDirty: function() {
        var instances = this.getInstances();
        for (var i = 0; i < instances.length; i++) {
            if (instances[i].isDirty()) return true;
        }
        return false;
    },

    /**
     *
     */
    unloadWarning: function() {
        var instances = this.getInstances();
        for (var i = 0; i < instances.length; i++) {
            if (instances[i].isDirty() &&
                    instances[i].isEditing() &&
                    instances[i].options.unloadWarning) {
                return _('navigateAway');
            }
        }
    },

    /*========================================================================*\
     * Plugins as UI
    \*========================================================================*/

    /**
     * Registers a new UI component, overriding any previous UI components registered with the same name.
     *
     * @param {String} name
     * @param {Object} ui
     */
    registerUi: function(ui) {
        // <strict>
        if (typeof ui !== 'object') {
            handleError(_('errorUINotObject', {
                ui: ui
            }));
            return;
        } else if (typeof ui.name !== 'string') {
            handleError(_('errorUINoName', {
                ui: ui
            }));
            return;
        } else if (this.ui[ui.name]) {
            handleError(_('errorUIOverride', {
                name: ui.name
            }));
        }
        // </strict>
        this.ui[ui.name] = ui;
    },

    /**
     * Registers a new layout, overriding any previous layout registered with the same name.
     *
     * @param {String} name
     * @param {Object} layout
     */
    registerLayout: function(layout) {
        // <strict>
        if (typeof layout !== 'object') {
            handleError('Layout "' + layout + '" is invalid (must be an object)');
            return;
        } else if (typeof layout.name !== 'string') {
            handleError('Layout "'+ layout + '" is invalid (must have a name property)');
            return;
        } else if (this.layouts[layout.name]) {
            handleError('Layout "' + layout.name + '" has already been registered, and will be overwritten');
        }
        // </strict>

        this.layouts[layout.name] = layout;
    },

    registerPlugin: function(plugin) {
        // <strict>
        if (typeof plugin !== 'object') {
            handleError('Plugin "' + plugin + '" is invalid (must be an object)');
            return;
        } else if (typeof plugin.name !== 'string') {
            handleError('Plugin "'+ plugin + '" is invalid (must have a name property)');
            return;
        } else if (this.plugins[plugin.name]) {
            handleError('Plugin "' + plugin.name + '" has already been registered, and will be overwritten');
        }
        // </strict>

        this.plugins[plugin.name] = plugin;
    },
            
    registerPreset: function(preset, setDefault) {
        // <strict>
        if (typeof preset !== 'object') {
            handleError('Preset "' + preset + '" is invalid (must be an object)');
            return;
        } else if (typeof preset.name !== 'string') {
            handleError('Preset "'+ preset + '" is invalid (must have a name property)');
            return;
        } else if (this.presets[preset.name]) {
            handleError('Preset "' + preset.name + '" has already been registered, and will be overwritten');
        }
        // </strict>

        this.presets[preset.name] = preset;
        if (setDefault) {
            this.defaults = preset;
        }
    },

    /*========================================================================*\
     * Events
    \*========================================================================*/

    /**
     * @param {String} name
     * @param {function} callback
     */
    bind: function(name, callback) {
        if (!this.events[name]) this.events[name] = [];
        this.events[name].push(callback);
    },

    /**
     * @param {function} callback
     */
    unbind: function(callback) {
        $.each(this.events, function(name) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] === callback) {
                    this.events[name].splice(i,1);
                }
            }
        });
    },

    /**
     * @param {String} name
     */
    fire: function(name) {
        // <debug>
        if (debugLevel > MAX) {
            debug('Firing global/static event: ' + name);
        }
        // </debug>
        if (!this.events[name]) {
            return;
        }
        for (var i = 0, l = this.events[name].length; i < l; i++) {
            this.events[name][i].call(this);
        }
    },

    /*========================================================================*\
     * Persistance
    \*========================================================================*/
    /**
     * @param {String} key
     * @param {mixed} value
     * @param {String} namespace
     */
    persist: function(key, value, namespace) {
        key = namespace ? namespace + '.' + key : key;
        if (localStorage) {
            var storage;
            if (localStorage.uiWidgetEditor) {
                storage = JSON.parse(localStorage.uiWidgetEditor);
            } else {
                storage = {};
            }
            if (value === undefined) return storage[key];
            storage[key] = value;
            localStorage.uiWidgetEditor = JSON.stringify(storage);
        }

        return value;
    }

};
