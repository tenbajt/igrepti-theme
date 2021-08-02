function Dropdown(toggler) {
  this.toggler   = toggler;
  this.menu      = toggler.nextElementSibling;
  this.container = toggler.parentElement;

  if (this.menu === null) return;

  this.togglerClickListener  = this.togglerClickListener.bind(this);
  this.documentClickListener = this.documentClickListener.bind(this);

  this.toggler.addEventListener('click', this.togglerClickListener);
}

Dropdown.prototype.show = function() {
  this.toggler.dataset.state = 'toggled';
  this.menu.   dataset.state = 'expanded';
  document.addEventListener('click', this.documentClickListener);
}

Dropdown.prototype.hide = function() {
  this.toggler.dataset.state = 'default';
  this.menu.   dataset.state = 'default';
  document.removeEventListener('click', this.documentClickListener);
}

Dropdown.prototype.toggle = function() {
  if (this.toggler.dataset.state === 'toggled') {
    this.hide();
  } else {
    this.show();
  }
}

Dropdown.prototype.togglerClickListener = function() {
  this.toggle();
}

Dropdown.prototype.documentClickListener = function(event) {
  if (!this.container.contains(event.target)) {
    this.hide();
  }
}

document.querySelectorAll('.dropdown-toggler').forEach(function(toggler) {
  new Dropdown(toggler);
});