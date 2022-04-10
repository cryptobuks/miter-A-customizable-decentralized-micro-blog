// limit
var count = "250";
function limiter(){
	var tex = document.miterform.miter.value;
	var len = tex.length;
	var sub_but = document.getElementById('sub_but');
	if(len > count){
        sub_but.disabled = true;
		sub_but.style.color = '#c10000';
        if (document.getElementById('overchar').checked) {
            sub_but.disabled = false;
        }
	} else {
	    sub_but.disabled = false;
		sub_but.style.color = '#000000';
	}	
	document.miterform.submit.value = count-len;
}

// delete miters
function confirm_delete() {
	return confirm('Delete?');
}

// validate miter
function validate() {
    var miterbox = document.forms["miterform"]["miter"].value;
    if (miterbox == "") {
        return false;
	}
}

// miter inserts
var more_buttons_dropdown = document.getElementById('more_buttons_dropdown');

more_buttons_dropdown.onchange = function() {
    var txtarea = document.getElementById('miter');
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

// upload filename insert into field
const uploadBTN = document.getElementById('upload');
uploadBTN.addEventListener('change',
function() {
    document.getElementById('url').value = this.files[0].name
})

