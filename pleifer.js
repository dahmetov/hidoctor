let alphabet = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'];
let message = "Привет это текст сообщения".replace(/ /g,'')
let key = 'ключ'
if(message %2 !== 0) {
    message += 'х'
}
let chunks = chunk(message.toUpperCase().split(''), 2);

console.log(encode(chunks, key).join(''));

function encode(chunks, key) {
    let newAlpha = createMatrix(key, alphabet)
    let encoded = [];

    for (let i = 0; i < chunks.length; i++) {
        let [firstLetter, secondLetter] = chunks[i].split('')

        let [firstLetterRowIndex, firstLetterColIndex] = getIndexOfK(newAlpha, firstLetter)
        let [secondLetterRowIndex, secondLetterColIndex] = getIndexOfK(newAlpha, secondLetter)

        if(firstLetterRowIndex === secondLetterRowIndex) {
            if(firstLetterColIndex + 1 > 7) {
                firstLetterColIndex -= 8
            }
            if(secondLetterColIndex + 1 > 7) {
                secondLetterColIndex -= 8
            }
             encoded.push(newAlpha[firstLetterRowIndex][firstLetterColIndex+1])
             encoded.push(newAlpha[secondLetterRowIndex][secondLetterColIndex+1])
        } else if(firstLetterColIndex === secondLetterColIndex) {
            if(firstLetterRowIndex + 1 > 3) {
                firstLetterRowIndex -= 4
            }
            if(secondLetterRowIndex + 1 > 3) {
                secondLetterRowIndex -= 4
            }
            encoded.push(newAlpha[firstLetterRowIndex+1][firstLetterColIndex])
            encoded.push(newAlpha[secondLetterRowIndex+1][secondLetterColIndex])
        } else {
            encoded.push(newAlpha[secondLetterRowIndex][firstLetterColIndex])
            encoded.push(newAlpha[firstLetterRowIndex][secondLetterColIndex])
        }

    }
    return encoded;
}

function chunk(arr, len) {
    let chunks = [],
        i = 0,
        n = arr.length;
    while (i < n) {
        chunks.push(arr.slice(i, i += len).join(''));
    }
    return chunks;
}

function getIndexOfK(arr, k) {
    for (let i = 0; i < arr.length; i++) {
        let index = arr[i].indexOf(k);
        if (index > -1) {
            return [i, index];
        }
    }
}

function createMatrix(key, alphabet) {
    key = key.toUpperCase().split('');
    key = key.concat(alphabet);
    key = key.filter((a, b) => key.indexOf(a) === b)
    let result = Array(4).fill(0).map(() => new Array(8).fill(0));
    let index = 0;
    for (let i = 0; i < 4; i++) {
        for (let j = 0; j < 8; j++) {
            result[i][j] = key[index]
            index++
        }
    }
    return result
}