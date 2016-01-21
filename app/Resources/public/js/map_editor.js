
$('.editor-mode').change(function() {
    if (editor.dirty) {
        if (!window.confirm('There are unsaved changes.Discard?')) {
            return;
        }
    }
    editor.mode = $(this).val();
    editor.reset();
});

$('.editor-cancel').click(function() {
    editor.reset();
});

$('.editor-finish').click(function() {
    editor.finish();
});

$(document).ready(function() {

    $('#mark_mountains').change(function() {
        app.mode = 'mark_mountains';
    });


    window.setTimeout(function() {
        editor.reset();
    }, 500);
});