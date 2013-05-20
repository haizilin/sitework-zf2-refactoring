/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icons\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-star' : '&#xe02f;',
			'icon-star-2' : '&#xe030;',
			'icon-star-3' : '&#xe031;',
			'icon-undo' : '&#xf0e2;',
			'icon-table' : '&#xf0ce;',
			'icon-circle-arrow-left' : '&#xf0a8;',
			'icon-circle-arrow-right' : '&#xf0a9;',
			'icon-arrow-left' : '&#xf060;',
			'icon-arrow-right' : '&#xf061;',
			'icon-chevron-left' : '&#xf053;',
			'icon-chevron-right' : '&#xf054;',
			'icon-phone-sign' : '&#xf098;',
			'icon-globe' : '&#xf0ac;',
			'icon-upload-alt' : '&#xf093;',
			'icon-calendar' : '&#xf073;',
			'icon-wrench' : '&#xf0ad;',
			'icon-caret-right' : '&#xf0da;',
			'icon-caret-left' : '&#xf0d9;',
			'icon-caret-up' : '&#xf0d8;',
			'icon-caret-down' : '&#xf0d7;',
			'icon-sort' : '&#xf0dc;',
			'icon-trash' : '&#xf014;',
			'icon-home' : '&#xf015;',
			'icon-download-alt' : '&#xf019;',
			'icon-refresh' : '&#xf021;',
			'icon-cogs' : '&#xf085;',
			'icon-plus' : '&#xf067;',
			'icon-minus' : '&#xf068;',
			'icon-xing' : '&#xe014;',
			'icon-tumblr' : '&#xe016;',
			'icon-facebook' : '&#xe003;',
			'icon-google-plus' : '&#xe005;',
			'icon-linkedin' : '&#xe053;',
			'icon-github' : '&#xe00a;',
			'icon-twitter' : '&#xe004;',
			'icon-key' : '&#xe04a;',
			'icon-lock' : '&#xe048;',
			'icon-switch' : '&#xe04d;',
			'icon-unlocked' : '&#xe049;',
			'icon-attachment' : '&#xe032;',
			'icon-ok' : '&#xf00c;',
			'icon-remove' : '&#xf00d;',
			'icon-remove-sign' : '&#xf057;',
			'icon-ok-sign' : '&#xf058;',
			'icon-plus-sign' : '&#xf055;',
			'icon-minus-sign' : '&#xf056;',
			'icon-question-sign' : '&#xf059;',
			'icon-info-sign' : '&#xf05a;',
			'icon-remove-circle' : '&#xf05c;',
			'icon-ok-circle' : '&#xf05d;',
			'icon-ban-circle' : '&#xf05e;',
			'icon-warning-sign' : '&#xf071;',
			'icon-exclamation-sign' : '&#xf06a;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};