-- Script pour corriger les problèmes de base de données
USE service_connect;

-- Vérifier la structure des tables
DESCRIBE provider_profiles;
DESCRIBE client_profiles;

-- S'assurer que la colonne is_available existe dans provider_profiles
ALTER TABLE provider_profiles 
ADD COLUMN IF NOT EXISTS is_available BOOLEAN DEFAULT TRUE;

-- S'assurer que tous les prestataires ont un profil
INSERT INTO provider_profiles (user_id, is_available, created_at, updated_at)
SELECT id, TRUE, NOW(), NOW()
FROM users 
WHERE role = 'prestataire' 
AND id NOT IN (SELECT user_id FROM provider_profiles);

-- S'assurer que tous les clients ont un profil
INSERT INTO client_profiles (user_id, created_at, updated_at)
SELECT id, NOW(), NOW()
FROM users 
WHERE role = 'client' 
AND id NOT IN (SELECT user_id FROM client_profiles);

-- Vérifier les données
SELECT 'Utilisateurs sans profil prestataire:' as info;
SELECT COUNT(*) as count 
FROM users u 
LEFT JOIN provider_profiles pp ON u.id = pp.user_id 
WHERE u.role = 'prestataire' AND pp.id IS NULL;

SELECT 'Utilisateurs sans profil client:' as info;
SELECT COUNT(*) as count 
FROM users u 
LEFT JOIN client_profiles cp ON u.id = cp.user_id 
WHERE u.role = 'client' AND cp.id IS NULL;
