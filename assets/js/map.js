// var map = L.map('map').setView([45.4397, 4.3872], 13);

// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
// }).addTo(map);

// // Vérifier que les données sont bien envoyées et parsées
// console.log("Lieux Data:", lieuxData);
// console.log("Itinéraires Data:", itinerairesData);

// let markersLieux = [];  // Tableau pour les marqueurs des lieux
// let markersItineraires = [];  // Tableau pour les marqueurs des itinéraires
// let polyline = null; // Variable unique pour le tracé des itinéraires

// // Fonction pour afficher les lieux filtrés
// function afficherLieux(categorie) {
//     // Retirer les marqueurs existants de la carte (lieux)
//     markersLieux.forEach(marker => map.removeLayer(marker));
//     markersLieux = [];  // Réinitialiser les marqueurs des lieux

//     // Vérification si les lieuxData est un tableau
//     if (Array.isArray(lieuxData)) {
//         lieuxData.forEach(lieu => {
//             if (lieu.latitude && lieu.longitude) {
//                 const categoriesLieu = lieu.categories.map(c => c.name);
//                 if (categorie === "all" || categoriesLieu.includes(categorie)) {
//                     let marker = L.marker([lieu.latitude, lieu.longitude]).addTo(map).bindPopup(`<b>${lieu.name}</b><br>${categoriesLieu.join(', ')}`);
//                     markersLieux.push(marker);  // Ajouter le marqueur des lieux
//                 }
//             }
//         });
//     } else {
//         console.error("lieuxData n'est pas un tableau :", lieuxData);
//     }
// }

// // Afficher tous les lieux au chargement de la page
// afficherLieux("all");

// // Fonction pour afficher l'itinéraire sélectionné
// function afficherItineraire(itineraireId) {
//     // Retirer les marqueurs existants de la carte (itinéraires)
//     markersItineraires.forEach(marker => map.removeLayer(marker));
//     markersItineraires = [];  // Réinitialiser les marqueurs des itinéraires
    
//     // Retirer le polyline existant, si présent
//     if (polyline) {
//         map.removeLayer(polyline);
//         polyline = null;
//     }

//     // Trouver l'itinéraire sélectionné
//     const itineraire = itinerairesData.find(i => i.id == itineraireId);
//     if (itineraire) {
//         // Afficher les marqueurs pour chaque lieu dans l'itinéraire
//         itineraire.lieux.forEach(lieuId => {
//             const lieu = lieuxData.find(l => l.id == lieuId);
//             if (lieu && lieu.latitude && lieu.longitude) {
//                 let marker = L.marker([lieu.latitude, lieu.longitude]).addTo(map).bindPopup(`<b>${lieu.name}</b>`);
//                 markersItineraires.push(marker);  // Ajouter le marqueur des itinéraires
//             }
//         });

//         // Créer un tracé (polyline) pour l'itinéraire
//         const latLngs = itineraire.lieux.map(lieuId => {
//             const lieu = lieuxData.find(l => l.id == lieuId);
//             return [lieu.latitude, lieu.longitude];
//         });

//         polyline = L.polyline(latLngs, {color: 'blue'}).addTo(map);  // Utiliser la variable unique pour polyline
//         map.fitBounds(polyline.getBounds());
//     }
// }

// // Afficher tous les itinéraires au chargement de la page
// // Il est possible de commencer par afficher un itinéraire par défaut, par exemple, le premier itinéraire.
// if (itinerairesData.length > 0) {
//     afficherItineraire(itinerairesData[0].id);
// }

// // Écouter les changements dans le filtre des catégories
// document.getElementById("categoryFilter").addEventListener("change", function () {
//     afficherLieux(this.value);
// });

// // Écouter les changements dans le filtre des itinéraires
// document.getElementById("itineraireFilter").addEventListener("change", function () {
//     afficherItineraire(this.value);
// });
