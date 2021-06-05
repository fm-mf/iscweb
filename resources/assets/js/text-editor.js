import tinymce from 'tinymce/tinymce';

import 'tinymce/icons/default';
import 'tinymce/themes/silver';

import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/autosave';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/code';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/nonbreaking';
import 'tinymce/plugins/paste';
import 'tinymce/plugins/quickbars';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/textpattern';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/visualchars';
import 'tinymce/plugins/wordcount';

import 'tinymce/skins/ui/oxide/skin.css';
import 'tinymce/skins/ui/oxide/content.css';

import 'tinymce/plugins/emoticons/js/emojis';

tinymce.init({
    selector: 'textarea',
    plugins: [
        'advlist',
        'autolink',
        'autosave',
        'charmap',
        'code',
        'emoticons',
        'fullscreen',
        'insertdatetime',
        'link',
        'lists',
        'nonbreaking',
        'paste',
        'quickbars',
        'searchreplace',
        'table',
        'textpattern',
        'visualblocks',
        'visualchars',
        'wordcount',
    ],
    toolbar:
        'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | link emoticons',
    skin: false,
    content_css: [
        `${window.location.origin}/css/vendor.css`,
        `${window.location.origin}/css/web.css`,
    ],
    body_class: 'container-fluid my-3',
    contextmenu: false,
    browser_spellcheck: true,
    default_link_target: '_blank',
    link_default_protocol: 'https',
    branding: false,
});
