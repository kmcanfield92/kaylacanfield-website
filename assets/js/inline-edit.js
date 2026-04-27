/**
 * Kayla Canfield Portfolio — Inline Preview Editor
 * Adds a floating toolbar to enable click-to-edit on any text element.
 * Changes are saved to localStorage so they persist across page refreshes.
 * A "Reset" button restores original content.
 */
(function () {
  'use strict';

  /* ── Editable selectors ── */
  const EDITABLE_SELECTORS = [
    'h1','h2','h3','h4','h5','h6',
    'p','li','blockquote','cite',
    '.kc-hero__body','.kc-hero__script',
    '.kc-sidebar__bio','.kc-sidebar__quote',
    '.kc-work-card__title','.kc-work-card__desc','.kc-work-card__cat',
    '.kc-blog-post-card__title','.kc-blog-post-card__excerpt',
    '.kc-about-teaser p',
    '.kc-body','.kc-script',
    '.kc-section-sub','.kc-subheading',
    '.kc-eyebrow','.kc-section-eyebrow',
    '.kc-sidebar-widget p',
    '.kc-sidebar-reading li',
    '.kc-skills-card p','.kc-skills-card h3',
    '.kc-meta-item__value',
    'figcaption','.kc-photo-caption'
  ].join(',');

  const STORAGE_KEY = 'kc_inline_edits_' + location.pathname;
  let editMode = false;
  let toolbar, toggleBtn, statusDot, statusLabel, saveBtn, resetBtn;

  /* ── Build toolbar UI ── */
  function buildToolbar() {
    toolbar = document.createElement('div');
    toolbar.id = 'kc-edit-toolbar';
    toolbar.innerHTML = `
      <style>
        #kc-edit-toolbar {
          position: fixed;
          bottom: 24px;
          right: 24px;
          z-index: 9999;
          display: flex;
          align-items: center;
          gap: 8px;
          background: #1a1a1a;
          border: 2px solid #c8a84b;
          border-radius: 40px;
          padding: 8px 16px;
          box-shadow: 4px 4px 0 rgba(0,0,0,0.4);
          font-family: 'Tenor Sans','Trebuchet MS',sans-serif;
          font-size: 11px;
          letter-spacing: 0.1em;
          text-transform: uppercase;
          color: #fdf6e3;
          user-select: none;
          transition: opacity 0.2s;
        }
        #kc-edit-toolbar .kc-tb-dot {
          width: 8px; height: 8px;
          border-radius: 50%;
          background: #c8a84b;
          flex-shrink: 0;
          transition: background 0.2s;
        }
        #kc-edit-toolbar.edit-active .kc-tb-dot { background: #27ae60; }
        #kc-edit-toolbar button {
          background: transparent;
          border: 1.5px solid rgba(253,246,227,0.4);
          border-radius: 20px;
          color: #fdf6e3;
          font-family: inherit;
          font-size: 10px;
          letter-spacing: 0.1em;
          text-transform: uppercase;
          padding: 4px 12px;
          cursor: pointer;
          transition: all 0.15s;
        }
        #kc-edit-toolbar button:hover { background: rgba(255,255,255,0.1); border-color: #c8a84b; color: #c8a84b; }
        #kc-edit-toolbar #kc-tb-toggle { border-color: #c8a84b; color: #c8a84b; font-weight: 600; }
        #kc-edit-toolbar.edit-active #kc-tb-toggle { background: #c8a84b; color: #1a1a1a; border-color: #c8a84b; }
        #kc-edit-toolbar #kc-tb-save { display: none; }
        #kc-edit-toolbar.edit-active #kc-tb-save { display: inline-block; }
        #kc-edit-toolbar #kc-tb-reset { display: none; }
        #kc-edit-toolbar.edit-active #kc-tb-reset { display: inline-block; }
        /* Editable element highlight */
        .kc-editable-hover { outline: 2px dashed rgba(200,168,75,0.5) !important; cursor: text !important; }
        .kc-editable-active { outline: 2px solid #c8a84b !important; background: rgba(200,168,75,0.06) !important; }
        /* Toast */
        #kc-toast {
          position: fixed; bottom: 80px; right: 24px; z-index: 10000;
          background: #27ae60; color: white;
          font-family: 'Tenor Sans','Trebuchet MS',sans-serif;
          font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase;
          padding: 8px 18px; border-radius: 20px;
          opacity: 0; transition: opacity 0.3s;
          pointer-events: none;
        }
        #kc-toast.show { opacity: 1; }
      </style>
      <span class="kc-tb-dot" id="kc-tb-dot"></span>
      <span id="kc-tb-label">Preview Mode</span>
      <button id="kc-tb-toggle">Edit</button>
      <button id="kc-tb-save">Save</button>
      <button id="kc-tb-reset">Reset</button>
    `;
    document.body.appendChild(toolbar);

    const toast = document.createElement('div');
    toast.id = 'kc-toast';
    document.body.appendChild(toast);

    statusDot   = toolbar.querySelector('#kc-tb-dot');
    statusLabel = toolbar.querySelector('#kc-tb-label');
    toggleBtn   = toolbar.querySelector('#kc-tb-toggle');
    saveBtn     = toolbar.querySelector('#kc-tb-save');
    resetBtn    = toolbar.querySelector('#kc-tb-reset');

    toggleBtn.addEventListener('click', toggleEditMode);
    saveBtn.addEventListener('click', saveEdits);
    resetBtn.addEventListener('click', resetEdits);
  }

  /* ── Toggle edit mode ── */
  function toggleEditMode() {
    editMode = !editMode;
    toolbar.classList.toggle('edit-active', editMode);
    statusLabel.textContent = editMode ? 'Editing' : 'Preview Mode';
    toggleBtn.textContent   = editMode ? 'Done' : 'Edit';

    const elements = document.querySelectorAll(EDITABLE_SELECTORS);
    elements.forEach(el => {
      if (editMode) {
        el.setAttribute('contenteditable', 'true');
        el.addEventListener('mouseenter', onHover);
        el.addEventListener('mouseleave', offHover);
        el.addEventListener('focus', onFocus, true);
        el.addEventListener('blur', onBlur, true);
      } else {
        el.removeAttribute('contenteditable');
        el.removeEventListener('mouseenter', onHover);
        el.removeEventListener('mouseleave', offHover);
        el.removeEventListener('focus', onFocus, true);
        el.removeEventListener('blur', onBlur, true);
        el.classList.remove('kc-editable-hover','kc-editable-active');
      }
    });
  }

  function onHover()  { this.classList.add('kc-editable-hover'); }
  function offHover() { this.classList.remove('kc-editable-hover'); }
  function onFocus()  { this.classList.add('kc-editable-active'); }
  function onBlur()   { this.classList.remove('kc-editable-active'); }

  /* ── Save edits to localStorage ── */
  function saveEdits() {
    const edits = {};
    const elements = document.querySelectorAll(EDITABLE_SELECTORS);
    elements.forEach((el, i) => {
      const key = getKey(el, i);
      edits[key] = el.innerHTML;
    });
    localStorage.setItem(STORAGE_KEY, JSON.stringify(edits));
    showToast('Changes saved!');
  }

  /* ── Restore saved edits on load ── */
  function restoreEdits() {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    try {
      const edits = JSON.parse(raw);
      const elements = document.querySelectorAll(EDITABLE_SELECTORS);
      elements.forEach((el, i) => {
        const key = getKey(el, i);
        if (edits[key] !== undefined) el.innerHTML = edits[key];
      });
    } catch (e) { /* ignore */ }
  }

  /* ── Reset to original ── */
  function resetEdits() {
    if (!confirm('Reset all edits on this page to the original text?')) return;
    localStorage.removeItem(STORAGE_KEY);
    location.reload();
  }

  /* ── Stable key for each element ── */
  function getKey(el, fallbackIndex) {
    return el.tagName + '_' + (el.id || el.className.split(' ')[0] || '') + '_' + fallbackIndex;
  }

  /* ── Toast notification ── */
  function showToast(msg) {
    const t = document.getElementById('kc-toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 2200);
  }

  /* ── Init ── */
  document.addEventListener('DOMContentLoaded', function () {
    buildToolbar();
    restoreEdits();
  });
})();
