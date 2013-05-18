/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'sitework\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-github' : '&#xe012;',
			'icon-github-2' : '&#xe007;',
			'icon-github-3' : '&#xe00a;',
			'icon-github-4' : '&#xe009;',
			'icon-tumblr' : '&#xe016;',
			'icon-tumblr-2' : '&#xe017;',
			'icon-xing' : '&#xe014;',
			'icon-xing-2' : '&#xe015;',
			'icon-android' : '&#xe000;',
			'icon-tux' : '&#xe001;',
			'icon-windows8' : '&#xe002;',
			'icon-feed' : '&#xe010;',
			'icon-feed-2' : '&#xe00f;',
			'icon-twitter' : '&#xe004;',
			'icon-twitter-2' : '&#xe00d;',
			'icon-facebook' : '&#xe003;',
			'icon-facebook-2' : '&#xe00b;',
			'icon-google-plus' : '&#xe005;',
			'icon-google-plus-2' : '&#xe006;',
			'icon-notification' : '&#xe008;',
			'icon-question' : '&#xe00c;',
			'icon-info' : '&#xe00e;',
			'icon-exit' : '&#xe011;',
			'icon-checkmark' : '&#xe013;',
			'icon-close' : '&#xe018;',
			'icon-spam' : '&#xe019;',
			'icon-checkmark-2' : '&#xe01a;',
			'icon-blocked' : '&#xe01b;',
			'icon-cancel-circle' : '&#xe01c;',
			'icon-checkmark-circle' : '&#xe01d;',
			'icon-info-2' : '&#xe01e;',
			'icon-warning' : '&#xe01f;',
			'icon-checkbox-checked' : '&#xe020;',
			'icon-checkbox-unchecked' : '&#xe021;',
			'icon-checkbox-partial' : '&#xe022;',
			'icon-filter' : '&#xe023;',
			'icon-filter-2' : '&#xe024;',
			'icon-radio-unchecked' : '&#xe025;',
			'icon-radio-checked' : '&#xe026;',
			'icon-arrow-left' : '&#xe027;',
			'icon-arrow-right' : '&#xe028;',
			'icon-minus' : '&#xe029;',
			'icon-plus' : '&#xe02a;',
			'icon-download' : '&#xe02b;',
			'icon-upload' : '&#xe02c;',
			'icon-remove' : '&#xe02d;',
			'icon-remove-2' : '&#xe02e;',
			'icon-star' : '&#xe02f;',
			'icon-star-2' : '&#xe030;',
			'icon-star-3' : '&#xe031;',
			'icon-attachment' : '&#xe032;',
			'icon-tree' : '&#xe033;',
			'icon-calendar' : '&#xe034;',
			'icon-calendar-2' : '&#xe035;',
			'icon-clock' : '&#xe036;',
			'icon-clock-2' : '&#xe037;',
			'icon-home' : '&#xe038;',
			'icon-pencil' : '&#xe039;',
			'icon-image' : '&#xe03a;',
			'icon-camera' : '&#xe03b;',
			'icon-phone-hang-up' : '&#xe03c;',
			'icon-phone' : '&#xe03d;',
			'icon-print' : '&#xe03e;',
			'icon-alarm' : '&#xe03f;',
			'icon-alarm-2' : '&#xe040;',
			'icon-image-2' : '&#xe041;',
			'icon-search' : '&#xe042;',
			'icon-zoom-in' : '&#xe043;',
			'icon-zoom-out' : '&#xe044;',
			'icon-trophy' : '&#xe045;',
			'icon-spinner' : '&#xe046;',
			'icon-wrench' : '&#xe047;',
			'icon-lock' : '&#xe048;',
			'icon-unlocked' : '&#xe049;',
			'icon-key' : '&#xe04a;',
			'icon-cogs' : '&#xe04b;',
			'icon-cog' : '&#xe04c;',
			'icon-switch' : '&#xe04d;',
			'icon-earth' : '&#xe04e;',
			'icon-user' : '&#xe04f;',
			'icon-users' : '&#xe050;',
			'icon-thumbs-up' : '&#xe051;',
			'icon-thumbs-up-2' : '&#xe052;',
			'icon-linkedin' : '&#xe053;',
			'icon-github-5' : '&#xe054;',
			'icon-skype' : '&#xe055;',
			'icon-play' : '&#xe056;',
			'icon-pause' : '&#xe057;',
			'icon-stop' : '&#xe058;',
			'icon-backward' : '&#xe059;',
			'icon-forward' : '&#xe05a;',
			'icon-first' : '&#xe05b;',
			'icon-last' : '&#xe05c;',
			'icon-mobile' : '&#xe05d;',
			'icon-location' : '&#xe05e;',
			'icon-location-2' : '&#xe05f;',
			'icon-pushpin' : '&#xe060;',
			'icon-envelop' : '&#xe061;',
			'icon-cog-2' : '&#xe062;',
			'icon-sad' : '&#xe064;',
			'icon-smiley' : '&#xe063;',
			'icon-smiley-2' : '&#xe065;',
			'icon-sad-2' : '&#xe066;'
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