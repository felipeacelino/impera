// URL Base
const url_base = $("#infos").data("url-base");

// DEBOUNCE (Melhora a performance de funções repetitivas como "Scroll / Resize")
const debounce = function (n, t, u) {
  var e;
  return function () {
    var a = this,
      i = arguments,
      o = function () {
        (e = null), u || n.apply(a, i);
      },
      r = u && !e;
    clearTimeout(e), (e = setTimeout(o, t)), r && n.apply(a, i);
  };
};

// Verifica se o tamanho da tela é menor do que o tamanho passado (Útil em caso de verificação de responsividade)
function isMobileX(screenSize) {
  return $(window).width() < screenSize;
}

// Formata um valor para o formato de moeda real (R$)
function formataMoeda(v, c, d, t) {
  var n = v,
    c = isNaN((c = Math.abs(c))) ? 2 : c,
    d = d == undefined ? "," : d,
    t = t == undefined ? "." : t,
    s = n < 0 ? "-" : "",
    i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
  return (
    s +
    (j ? i.substr(0, j) + t : "") +
    i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
    (c
      ? d +
        Math.abs(n - i)
          .toFixed(c)
          .slice(2)
      : "")
  );
}

// Copia uma string para a área de transferência
function copyToClipboard(str) {
  const el = document.createElement("textarea");
  el.value = str;
  el.setAttribute("readonly", "");
  el.style.position = "absolute";
  el.style.left = "-9999px";
  document.body.appendChild(el);
  const selected =
    document.getSelection().rangeCount > 0
      ? document.getSelection().getRangeAt(0)
      : false;
  el.select();
  document.execCommand("copy");
  document.body.removeChild(el);
  if (selected) {
    document.getSelection().removeAllRanges();
    document.getSelection().addRange(selected);
  }
}

// Converte uma data para o formato BR
function formataDataBr(data) {
  var dataArray = data.split("-");
  return dataArray[2] + "/" + dataArray[1] + "/" + dataArray[0];
}

// Converte uma string (BR) para objeto data
function dataToObj(data) {
  var dataArray = data.split("/");
  var dia = parseInt(dataArray[0]);
  var mes = parseInt(dataArray[1]);
  var ano = parseInt(dataArray[2]);
  var dataObj = new Date(ano, mes - 1, dia);
  return dataObj;
}

// Obtém um array do range entre duas datas
function getDateRange(data1, data2) {
  var dateRange = [];
  var dia = data1.getDate() < 10 ? "0" + data1.getDate() : data1.getDate();
  var mes = data1.getMonth() + 1;
  mes = mes < 10 ? "0" + mes : mes;
  var ano = data1.getFullYear();
  //dateRange.push(ano+'-'+mes+'-'+dia);
  dateRange.push(dia + "/" + mes + "/" + ano);
  while (data1 < data2) {
    var dateNew = new Date(data1.setDate(data1.getDate() + 1));
    dia = dateNew.getDate() < 10 ? "0" + dateNew.getDate() : dateNew.getDate();
    mes = dateNew.getMonth() + 1;
    mes = mes < 10 ? "0" + mes : mes;
    ano = dateNew.getFullYear();
    //dateRange.push(ano+'-'+mes+'-'+dia);
    dateRange.push(dia + "/" + mes + "/" + ano);
  }
  return dateRange;
}

// Verifica no range selecionado se contém alguma data bloqueada
function rangeInvalido(datasBloqueadas, datasSelecionadas) {
  return datasSelecionadas.some(function (data) {
    return datasBloqueadas.some(function (dataBloqueada) {
      return data === dataBloqueada;
    });
  });
}

// Desabilida o clique do botão direito do mouse
function disableRightClick() {
  if ($(".btn-copy-link").length === 0) {
    $(window).on("contextmenu", function (ev) {
      ev.preventDefault();
    });
  }
}
disableRightClick();

// Desabilita a cópia de contéudo
/* $(function () {
  $("body").bind("copy paste", function (ev) {
    ev.preventDefault();
    return false;
  });
}); */
