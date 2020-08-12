document.getElementById('htmlButtonSend').addEventListener('click', async event => { //Клик по кнопке
  document.getElementById('htmlTextError').innerHTML = '';
  let link = document.getElementById('htmlInputLink').value.toLowerCase();
  let error = '';
  if (link.indexOf('.') == -1 ) {
    error = 'Введите корректную ссылку!';
  }
  if (link.search('http://') == -1 && link.search('https://') == -1) {
    link = 'http://' + link;
  }

  if (error.length > 0) {
    document.getElementById('htmlTextError').innerHTML = error;
    return 0;
  }

  const query = await fetch('createLink.php', {
    method: 'POST',
    body: JSON.stringify({'link': link}),
  });
  const result = await query.json();
  document.getElementById('htmlLinkResult').innerHTML = result.link;
  document.getElementById('htmlCopyInfo').innerHTML = ' [нажмите, чтобы скопировать]'
  document.getElementById('htmlCopyInfo').removeAttribute('style');
});

const copyToClipboard = str => {
  const el = document.createElement('textarea');
  el.value = str;
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
};

const copy = () => {
  copyToClipboard(document.getElementById('htmlLinkResult').innerHTML);
  document.getElementById('htmlCopyInfo').innerHTML = ' [скопировано]'
}