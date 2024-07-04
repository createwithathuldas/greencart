
function test(n) {
    if (n < 0)
        return false;
    single_digit = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine']
    double_digit = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen']
    below_hundred = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety']
    if (n === 0) return 'Zero'

    function translate(n) {
        word = ""
        if (n < 10) {
            word = single_digit[n] + ' '
        } else if (n < 20) {
            word = double_digit[n - 10] + ' '
        } else if (n < 100) {
            rem = translate(n % 10)
            word = below_hundred[(n - n % 10) / 10 - 2] + ' ' + rem
        } else if (n < 1000) {
            word = single_digit[Math.trunc(n / 100)] + ' Hundred ' + translate(n % 100)
        } else if (n < 1000000) {
            word = translate(parseInt(n / 1000)).trim() + ' Thousand ' + translate(n % 1000)
        } else if (n < 1000000000) {
            word = translate(parseInt(n / 1000000)).trim() + ' Million ' + translate(n % 1000000)
        } else {
            word = translate(parseInt(n / 1000000000)).trim() + ' Billion ' + translate(n % 1000000000)
        }
        return word
    }
    result = translate(n)
    document.getElementById('rupeesinwords').innerHTML = "Rupees "+ result.trim() +' only'
}
