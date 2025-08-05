function cclw_applyDynamicPlaceholdersAndLabels() {
  if (typeof cclw_dynamic_fields !== 'undefined') {
    ['billing', 'shipping'].forEach(function (type) {
      var fields = cclw_dynamic_fields[type] || {};
      Object.keys(fields).forEach(function (slug) {
        var input = document.querySelector('[name="' + type + '_' + slug + '"]');
        var label = input ? input.closest('.form-row')?.querySelector('label') : null;

        if (input && fields[slug].placeholder) {
          input.placeholder = fields[slug].placeholder;
        }

        if (label && fields[slug].label) {
          label.textContent = fields[slug].label;
        }
      });
    });
  }
}

document.addEventListener('DOMContentLoaded', cclw_applyDynamicPlaceholdersAndLabels);
jQuery(document.body).on('updated_checkout updated_wc_div', cclw_applyDynamicPlaceholdersAndLabels);
