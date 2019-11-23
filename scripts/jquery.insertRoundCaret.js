// JavaScript Document

//This bit of code has been built on variaas code found at mail-archive.com which is the jQuery adaptation of this bit of code at alexking.org
// slightly modified to allow different start/end tags

$.fn.insertRoundCaret = function (start_tag, end_tag) {
	return this.each(function(){
		strStart = '['+start_tag+']';
		strEnd = '[/'+end_tag+']';
		if (document.selection) {
			//IE support
			stringBefore = this.value;
			this.focus();
			sel = document.selection.createRange();
			insertstring = sel.text;
			fullinsertstring = strStart + sel.text + strEnd;
			sel.text = fullinsertstring;
			document.selection.empty();
			this.focus();
			stringAfter = this.value;
			i = stringAfter.lastIndexOf(fullinsertstring);
			range = this.createTextRange();
			numlines = stringBefore.substring(0,i).split("\n").length;
			i = i+3-numlines+tagName.length;
			j = insertstring.length;
			range.move("character",i);
			range.moveEnd("character",j);
			range.select();
		}else if (this.selectionStart || this.selectionStart == '0') {
			//MOZILLA/NETSCAPE support
			startPos = this.selectionStart;
			endPos = this.selectionEnd;
			scrollTop = this.scrollTop;
			this.value = this.value.substring(0, startPos) + strStart + this.value.substring(startPos,endPos) + strEnd + this.value.substring(endPos,this.value.length);
			this.focus();
			this.selectionStart = startPos + strStart.length ;
			this.selectionEnd = endPos + strStart.length;
			this.scrollTop = scrollTop;
		} else {
			this.value += strStart + strEnd;
			this.focus();
		}
	});
};