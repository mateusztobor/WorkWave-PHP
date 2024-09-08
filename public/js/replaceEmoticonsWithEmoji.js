const emojiMap = {
  ':)': '😊',
  ':D': '😃',
  ':(': '😞',
  ':O': '😲',
  ';)': '😉',
  '<3': '❤️',
  ':P': '😛',
  ':|': '😐',
  ':*': '😘',
  ':/': '😕',
  ':]': '😄',
  ':[': '😟',
  ':@': '😠',
  ':s': '😖',
  ':$': '🤑',
  ':|': '😐',
  ':x': '😵',
  ':o': '😮',
  ':C': '😰',
  ':\'(': '😢',
  ':}': '😏',
  ':{': '😒',
  ':8': '😎',
  ':#': '🤐',
  ':&': '🤔',
  ':*(': '😥',
  ':^)': '😆',
  ':vv': '😆',
  ':)))': '😆',
  ':###': '🤒',
  ':###': '🤢',
  ':**': '👅',
  ':-*': '😗',
  ':-)': '😊',
  ':-D': '😃',
  ':-(': '😞',
  ':-O': '😲',
  ';-)': '😉',
  '<3<3': '❤️❤️',
  ':-P': '😛',
  ':-|': '😐',
  '8-)': '😎',
  ':*-*': '😘',
  ':->': '😏',
  ':-[': '😟',
  ':-]': '😄',
  ':-{': '😒'
};
function replaceEmoticonsWithEmoji(text) {
  let newText = text;

  // Dopasowuje emotikony, które nie są częścią adresów URL
  const regex = /(^|\s)(?<!http:|https:)(:[\)\(DPO\[\]\\\|\/\]\}\*\-]|<3|:-?[\)]|:-?[DPPO\[\]\\\|\/\]\}\*\-]|;-?\)|<3<3)(?=\s|$)/g;

  newText = newText.replace(regex, (match, leadingSpace) => {
    const emoji = emojiMap[match.trim()];
    return emoji ? `${leadingSpace}${emoji}` : match;
  });

  return newText;
}