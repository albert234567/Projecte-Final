// Generar opciones de peso de 50 a 150 kg de 5 en 5
const pesoSelect = document.getElementById("peso");
for (let i = 50; i <= 150; i += 5) {
  const option = document.createElement("option");
  option.value = i;
  option.text = `${i} kg`;
  pesoSelect.appendChild(option);
}

// Generar opciones de ejercicio de 15 a 120 min de 15 en 15
const ejercicioSelect = document.getElementById("ejercicio");
for (let i = 15; i <= 120; i += 15) {
  const option = document.createElement("option");
  option.value = i;
  option.text = `${i} min`;
  ejercicioSelect.appendChild(option);
}

function calcularAgua() {
  const peso = parseFloat(document.getElementById("peso").value);
  const sexo = document.getElementById("sexo").value;
  const ejercicio = parseFloat(document.getElementById("ejercicio").value);
  const altura = parseFloat(document.getElementById("altura").value);
  const edad = parseFloat(document.getElementById("edad").value);

  if (isNaN(peso) || isNaN(ejercicio) || isNaN(altura) || isNaN(edad)) {
    document.getElementById("resultado").textContent = "Por favor, completá todos los campos.";
    return;
  }

  // Càlcul de les calories
  let tmb; // Taxa metabòlica basal (TMB)
  if (sexo === "hombre") {
    tmb = 88.362 + (13.397 * peso) + (4.799 * altura) - (5.677 * edad); // Fórmula home
  } else {
    tmb = 447.593 + (9.247 * peso) + (3.098 * altura) - (4.330 * edad); // Fórmula dona
  }

  // Factor d'activitat física (estimació)
  let factorActividad = 1.2; // Sedentari
  if (ejercicio >= 30 && ejercicio < 60) {
    factorActividad = 1.375; // Activitat lleu
  } else if (ejercicio >= 60 && ejercicio < 120) {
    factorActividad = 1.55; // Activitat moderada
  } else if (ejercicio >= 120) {
    factorActividad = 1.725; // Activitat intensa
  }

  const caloriasTotales = tmb * factorActividad; // Calories totals per dia

  // Macronutrients: proteïnes, greixos i carbohidrats
  const proteinas = (caloriasTotales * 0.2) / 4; // 20% de calories en proteïnes
  const grasas = (caloriasTotales * 0.3) / 9; // 30% de calories en greixos
  const carbohidratos = (caloriasTotales * 0.5) / 4; // 50% de calories en carbohidrats

  // Calcular l'aigua base per pes
  let base = peso * 35; // ml base
  if (sexo === "hombre") {
    base += 250;
  }

  // Aigua addicional per exercici
  const extra = ejercicio * 12;
  const totalMl = base + extra;
  const totalLitros = (totalMl / 1000).toFixed(2);

  const vasos = Math.round(totalMl / 250); // Vaso de 250 ml

  // Mostrar resultat
  document.getElementById("resultado").innerHTML =
    `Necesitás aproximadamente ${totalLitros} litros de agua al día <br>${vasos} vasos de agua de 250 ml.<br><br>` +
    `Calories diarias estimadas: ${caloriasTotales.toFixed(0)} kcal<br>` +
    `Proteínas: ${proteinas.toFixed(2)} g<br>` +
    `Grasas: ${grasas.toFixed(2)} g<br>` +
    `Carbohidratos: ${carbohidratos.toFixed(2)} g`;
}
