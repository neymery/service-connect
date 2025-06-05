-- Script pour ajouter des données supplémentaires de test
USE service_connect;

-- Ajouter quelques messages de test
INSERT INTO messages (sender_id, receiver_id, content, created_at, updated_at) VALUES
(1, 2, 'Bonjour, je suis intéressé par vos services de plomberie. Pourriez-vous me donner plus d\'informations ?', NOW(), NOW()),
(2, 1, 'Bonjour ! Je serais ravi de vous aider. Quel type de travaux de plomberie avez-vous besoin ?', NOW(), NOW()),
(1, 3, 'Salut, j\'ai besoin d\'un électricien pour installer quelques prises. Êtes-vous disponible cette semaine ?', NOW(), NOW());

-- Ajouter quelques évaluations de test
INSERT INTO ratings (client_id, provider_id, rating, comment, created_at, updated_at) VALUES
(1, 2, 5, 'Excellent travail ! Très professionnel et ponctuel. Je recommande vivement.', NOW(), NOW()),
(1, 3, 4, 'Bon service, travail de qualité. Juste un peu en retard sur l\'horaire prévu.', NOW(), NOW());

-- Vérifier les données insérées
SELECT 'Messages créés:' as info;
SELECT COUNT(*) as total_messages FROM messages;

SELECT 'Évaluations créées:' as info;
SELECT COUNT(*) as total_ratings FROM ratings;
