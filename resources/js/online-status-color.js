/**
 * Working Status - online presence dot tinting.
 *
 * Replaces the default green online indicator with each user's working status
 * color. Users without a status keep the default green dot.
 */
(function ($) {
    'use strict';

    function applyColors(map) {
        if (!map) {
            return;
        }
        document.querySelectorAll('img[data-contentcontainer-id]').forEach(function (img) {
            var id = img.getAttribute('data-contentcontainer-id');
            var color = map[id];
            if (!color) {
                return;
            }
            var wrapper = img.parentNode;
            if (!wrapper) {
                return;
            }
            var dot = wrapper.querySelector('.user-online-status.user-is-online');
            if (dot) {
                dot.style.backgroundColor = color;
            }
        });
    }

    function load() {
        var url = window.workingStatusColorsUrl;
        if (!url || !document.querySelector('img[data-contentcontainer-id]')) {
            return;
        }
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            credentials: 'same-origin'
        })
            .then(function (response) {
                return response.ok ? response.json() : {};
            })
            .then(applyColors)
            .catch(function () { /* fail silently, keep default dots */ });
    }

    $(function () {
        load();
    });

    // Re-apply after HumHub pjax navigations.
    $(document).on('pjax:end', load);
})(jQuery);
