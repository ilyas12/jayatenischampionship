

function x_cge(x_cgm) {
var x_cgn = document.getElementsByName('kerio_mode')[0];
var x_cgl = document.getElementById('x_cgl');
x_cgn.value = 'full-or-mini'; x_cgl.disabled = false;  x_cgl.checked = x_cgm || (document.cookie.indexOf('kerio_mode=mini') != -1); }

function x_cgk(x_cgo) {
var
x_1a6 = '',
x_cgp = new Date();
if (x_cgo) {
x_cgp.setDate(x_cgp.getDate() + 365); x_1a6 = 'kerio_mode=mini';
}
else {
x_cgp.setDate(x_cgp.getDate() - 365); x_1a6 = 'kerio_mode=full';
}
document.cookie = x_1a6 + ';expires=' + x_cgp.toGMTString();
}
var kerio = {};

function x_cgf() {
if (!(kerio.engine && kerio.engine.sso.isEnabled)) {
return;
}
var
img = new Image();
img.onerror = function() {
if (kerio.engine.sso.solveUrl) {
document.getElementById('x_cfs').innerHTML = '<a href="' + kerio.engine.sso.solveUrl + '">' + 'Confirm the certificate for an automated logon to other Kerio applications.' + '</a>';
}
};
img.onload = function() {
document.getElementsByName('kerio_sso')[0].value = '1';
};
img.src = kerio.engine.sso.probeUrl + 'rand=' + Math.random();
}