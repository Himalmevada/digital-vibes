/*!
 * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2021 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // CKEDITOR API
    ClassicEditor
        .create(document.querySelector('#editor'), {

            toolbar: {
                items: [
                    'heading',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    'subscript',
                    'superscript',
                    'link',
                    '|',
                    'alignment',
                    'bulletedList',
                    'numberedList',
                    'outdent',
                    'indent',
                    '|',
                    'blockQuote',
                    'mediaEmbed',
                    'removeFormat'
                ],
                shouldNotGroupWhenFull: true
            },
            language: 'en',
            licenseKey: 'OAVBHP860.IVX133XMH268',
            removePlugins: ['Title'],
            // placeholder: '',

        })
        .then(editor => {
            window.editor = editor;
            editor.ui.view.editable.element.style.height = '350px';

        })
        .catch(error => {
            console.error('Oops, something went wrong!');
            console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
            console.warn('Build id: 9a8qilh1w2m2-2o46zbqahcuw');
            console.error(error);
        });

});

// document.ready(function () {
    


    
//     function load_users_online() {
        
//         $.get("functions.php?online_users=result", function (data) {
//             $(".users_online_container").text(data);
//         })
        
//     }
    
//     setInterval(function () {
//         load_users_online();
//     }, 500);

// });