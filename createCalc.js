function createCalc() {

    let valueXDiv = document.createElement('div');
    let valueXLabel = document.createElement('label');
    let valueXInput = document.createElement('input');
    valueXInput.name = 'valueX';
    valueXInput.id = 'valueX';
    document.body.append(valueXDiv);
    valueXDiv.append(valueXLabel);
    valueXLabel.append(valueXInput);

    let selectOptionDiv = document.createElement('div');
    let selectOptionLabel = document.createElement('label');
    let selectOptionSelect = document.createElement('select');
    selectOptionSelect.name = 'selectOption';
    selectOptionSelect.id = 'selectOption';

    let optionSum = document.createElement("option");
    optionSum.value = '+';
    optionSum.text = 'Сложение (+)'
    let optionDifference = document.createElement("option");
    optionDifference.value = '-';
    optionDifference.text = 'Вычитание (-)'
    let optionMulti = document.createElement("option");
    optionMulti.value = '*';
    optionMulti.text = 'Умножение (*)'
    let optionDivision = document.createElement("option");
    optionDivision.value = ':';
    optionDivision.text = 'Деление (:)';

    document.body.append(selectOptionDiv);
    selectOptionDiv.append(selectOptionLabel);
    selectOptionLabel.append(selectOptionSelect);
    selectOptionSelect.append(optionSum);
    selectOptionSelect.append(optionDifference);
    selectOptionSelect.append(optionMulti);
    selectOptionSelect.append(optionDivision);

    let valueYDiv = document.createElement('div');
    let valueYLabel = document.createElement('label');
    let valueYInput = document.createElement('input');
    valueYInput.name = 'valueY';
    valueYInput.id = 'valueY';
    document.body.append(valueYDiv);
    valueYDiv.append(valueYLabel);
    valueYLabel.append(valueYInput);

    let buttonDiv = document.createElement('div');
    let calcButton = document.createElement("button");
    document.body.append(buttonDiv);
    buttonDiv.append(calcButton);
    calcButton.addEventListener('click', calculate);
    let calcButtonText = document.createTextNode('Вычислить');
    calcButton.append(calcButtonText);

    let errorDiv = document.createElement('div');
    errorDiv.classList.add('error');

    let resultDiv = document.createElement('div');
    resultDiv.classList.add('result');
    document.body.append(resultDiv);

    let lastResult = document.createElement('a');
    lastResult.href = 'calc-result.php';
    lastResult.target = '_blank';
    lastResult.text = 'Показать последний результат';
    document.body.append(lastResult);

    let lastSevenDetails = document.createElement("details");
    let lastSevenSummary = document.createElement('summary');
    document.body.append(lastSevenDetails);
    lastSevenDetails.append(lastSevenSummary);
    // lastSevenSummary.text = "Показать последние семь результатов";
    let lastSevenSummaryText = document.createTextNode('Показать последние семь результатов: ');
    lastSevenSummary.append(lastSevenSummaryText);

    let lastSevenDiv = document.createElement('div');
    lastSevenDiv.classList.add('lastResult');
    lastSevenDetails.append(lastSevenDiv);
}

document.addEventListener("DOMContentLoaded", createCalc);