/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
  // Layout da barra de opções
  config.toolbarGroups = [
    { name: "clipboard", groups: ["clipboard", "undo"] },
    { name: "styles", groups: ["styles"] },
    { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
    { name: "colors", groups: ["colors"] },
    {
      name: "paragraph",
      groups: ["blocks", "align", "list", "indent", "bidi", "paragraph"],
    },
    {
      name: "editing",
      groups: ["find", "selection", "spellchecker", "editing"],
    },
    { name: "forms", groups: ["forms"] },
    { name: "links", groups: ["links"] },
    { name: "insert", groups: ["insert"] },
    { name: "others", groups: ["others"] },
    { name: "tools", groups: ["tools"] },
    { name: "document", groups: ["mode", "document", "doctools"] },
    { name: "about", groups: ["about"] },
  ];

  // Opções ocultas
  config.removeButtons =
    "ShowBlocks,About,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Unlink,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Font,Scayt,SelectAll,Find,Replace,Cut,Copy,Paste,PasteText,PasteFromWord,Templates,Save,NewPage,Preview,Print,Styles,Outdent,Indent,Strike,RemoveFormat";
  config.removeDialogTabs = "image:advanced;link:advanced";

  // Idioma
  config.language = "pt-br";

  config.allowedContent = true;

  // Altura do editor
  config.height = 200;

  // Opções do formato do texto
  config.format_tags = "p;h2";

  // Código para upload de imagens
  config.filebrowserUploadUrl =
    url_script + "admin/editor/ckeditor/uploads/ck_upload.php";
  config.filebrowserUploadMethod = "form";
};
