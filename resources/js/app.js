import $ from 'jquery';
window.$ = $;
window.jQuery = $;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();
