document.getElementById('gemForm').addEventListener('submit', function (e) {
    const price = parseFloat(document.getElementById('price').value);
    const caratWeight = parseFloat(document.getElementById('carat_weight').value);

    if (isNaN(price) || isNaN(caratWeight)) {
        alert('Please enter valid numbers for Price and Carat Weight');
        e.preventDefault();
    }
});
