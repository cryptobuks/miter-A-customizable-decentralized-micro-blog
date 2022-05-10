function more_buttons() {
  var x_t = document.getElementById("button_div");
  if (x_t.style.display === "none") {
    x_t.style.display = "block";
  } else {
    x_t.style.display = "none";
  }
}

var tagtype = 'bbcode';
var id_txtfield = 'miter';

function cursorPosition(star, en, zon){
	
	var textarea = document.getElementById(zon);
	textarea.focus();
	
	var selection_range = document.selection.createRange().duplicate();
	
	if (selection_range.parentElement() == textarea) {
		
		var b_r = document.body.createTextRange();
		b_r.moveToElementText(textarea);
		b_r.setEndPoint("EndToStart", selection_range);
		
		var a_r = document.body.createTextRange();
		a_r.moveToElementText(textarea);
		a_r.setEndPoint("StartToEnd", selection_range);
		
		var b_f = false, s_f = false, a_f = false;
		var b_t, untr_b_t, s_t, untr_s_t, a_t, untr_a_t;
		
		b_t = untr_b_t = b_r.text;
		s_t = untr_s_t = selection_range.text;
		a_t = untr_a_t = a_r.text;
		
		do {
			if (!b_f) {
				if (b_r.compareEndPoints("StartToEnd", b_r) == 0) {
					b_f = true;
					} else {
					b_r.moveEnd("character", -1)
					if (b_r.text == b_t) {
						untr_b_t += "\r\n";
						} else {
						b_f = true;
					}
				}
			}
			if (!s_f) {
				if (selection_range.compareEndPoints("StartToEnd", selection_range) == 0) {
					s_f = true;
					} else {
					selection_range.moveEnd("character", -1)
					if (selection_range.text == s_t) {
						untr_s_t += "\r\n";
						} else {
						s_f = true;
					}
				}
			}
			if (!a_f) {
				if (a_r.compareEndPoints("StartToEnd", a_r) == 0) {
					a_f = true;
					} else {
					a_r.moveEnd("character", -1)
					if (a_r.text == a_t) {
						untr_a_t += "\r\n";
						} else {
						a_f = true;
					}
				}
			}
			
		} while ((!b_f || !s_f || !a_f));
		
		var re = new Array();
		re['startPos'] = untr_b_t.length;
		re['endPos'] = re['startPos'] + untr_s_t.length;
		re['final_text'] = untr_b_t +star+ untr_s_t +en+ untr_a_t;
		
		return re;
	}
}

function set_xpos(zona, Xpos) {
	var txtarea = document.getElementById(zona);
	if(txtarea != null) {
		if(txtarea.createTextRange) {
			var range = txtarea.createTextRange();
			range.move('character', Xpos);
			range.select();
		}
		else {
			if(txtarea.selectionStart) {
				txtarea.focus();
				txtarea.setSelectionRange(Xpos, Xpos);
			}
			else {
				txtarea.focus();
			}
		}
	}
}

function addTag(btn, type) {
	var tgop = (tagtype == 'html') ? '<' : '[';
	var tgen = (tagtype == 'html') ? '>' : ']';
	
	var start = tgop+btn.title+tgen;
	var end = tgop+'/'+btn.title+tgen;
	
	var txtarea = document.getElementById(id_txtfield);
	if (txtarea.selectionStart || txtarea.selectionStart==0) { 
		var rezult = new Array();
		rezult['startPos'] = txtarea.selectionStart;
		rezult['endPos'] = txtarea.selectionEnd;
		rezult['final_text'] = txtarea.value.substring(0, rezult['startPos']) + start + txtarea.value.substring(rezult['startPos'], rezult['endPos']) + end + txtarea.value.substring(rezult['endPos'], txtarea.value.length);
	}
	else if (document.selection) {
		var rezult = cursorPosition(start, end, id_txtfield);
	}
	
	txtarea.value = rezult['final_text'];
	var Xpos = rezult['endPos']+start.length;
	set_xpos(id_txtfield, Xpos);
}

function addSym(btn, type) {
	var tgop = (tagtype == 'html') ? '<' : '[';
	var tgen = (tagtype == 'html') ? '>' : ']';
	
	var start = btn.title;
	var end = '';
	
	var txtarea = document.getElementById(id_txtfield);
	if (txtarea.selectionStart || txtarea.selectionStart==0) { 
		var rezult = new Array();
		rezult['startPos'] = txtarea.selectionStart;
		rezult['endPos'] = txtarea.selectionEnd;
		rezult['final_text'] = txtarea.value.substring(0, rezult['startPos']) + start + txtarea.value.substring(rezult['startPos'], rezult['endPos']) + end + txtarea.value.substring(rezult['endPos'], txtarea.value.length);
	}
	else if (document.selection) {
		var rezult = cursorPosition(start, end, id_txtfield);
	}
	
	txtarea.value = rezult['final_text'];
	var Xpos = rezult['endPos']+start.length;
	set_xpos(id_txtfield, Xpos);
}

// upload filename insert into field
const uploadBTN = document.getElementById('upload');
uploadBTN.addEventListener('change',
function() {
    document.getElementById('url').value = this.files[0].name
})