var more_buttons_dropdown = document.getElementById('more_buttons_dropdown');

more_buttons_dropdown.onchange = function() {
    var txtarea = document.getElementById('tenon');
    var scrollPos = txtarea.scrollTop;
    var caretPos = txtarea.selectionStart;
    var front = (txtarea.value).substring(0, caretPos);
    var back = (txtarea.value).substring(txtarea.selectionEnd, txtarea.value.length);
    txtarea.value = front + this.value + back;
    caretPos = caretPos + this.length;
    txtarea.selectionStart = caretPos;
    txtarea.selectionEnd = caretPos;
    txtarea.focus();
    txtarea.scrollTop = scrollPos;
}