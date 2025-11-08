<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Module;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\AccessCode;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Create formateur user
        $formateur = User::factory()->create([
            'name' => 'Formateur User',
            'email' => 'formateur@example.com',
            'role' => 'formateur',
            'password' => bcrypt('password'),
        ]);

        // Create client user
        $client = User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'role' => 'client',
            'password' => bcrypt('password'),
        ]);

        // Additional test users
        $clients = User::factory(5)->create(['role' => 'client']);

        // Create test modules with chapters and lessons
        $this->createModuleWithContent($admin, 'Laravel pour Débutants', 'Apprenez les bases du framework Laravel', 25000, [
            'Introduction' => [
                ['Installation de Laravel', 'Guide complet pour installer Laravel sur votre machine', 15],
                ['Structure des dossiers', 'Comprendre l\'architecture MVC de Laravel', 20],
                ['Premier projet', 'Créer votre première application Laravel', 30],
            ],
            'Les Routes' => [
                ['Routes basiques', 'Définir des routes web et API', 25],
                ['Paramètres de routes', 'Gérer les paramètres dynamiques', 20],
                ['Middleware', 'Protéger vos routes avec des middleware', 35],
            ],
            'Les Contrôleurs' => [
                ['Créer un contrôleur', 'php artisan make:controller', 15],
                ['Méthodes CRUD', 'Create, Read, Update, Delete', 40],
            ],
        ]);

        $this->createModuleWithContent($formateur, 'JavaScript Moderne', 'Maîtrisez ES6+ et les frameworks JavaScript', 30000, [
            'Fondamentaux ES6' => [
                ['Let, Const et Var', 'Comprendre les déclarations de variables', 20],
                ['Arrow Functions', 'Syntaxe moderne des fonctions', 25],
                ['Destructuring', 'Extraction de valeurs simplifiée', 30],
            ],
            'Programmation Asynchrone' => [
                ['Promises', 'Gérer les opérations asynchrones', 35],
                ['Async/Await', 'Syntaxe moderne pour le code asynchrone', 40],
                ['Fetch API', 'Requêtes HTTP avec JavaScript', 30],
            ],
        ]);

        $this->createModuleWithContent($admin, 'PHP Avancé', 'Techniques avancées de programmation PHP', 35000, [
            'POO en PHP' => [
                ['Classes et Objets', 'Principes de base de la POO', 30],
                ['Héritage', 'Réutilisation de code avec l\'héritage', 35],
                ['Interfaces et Traits', 'Abstraction et composition', 40],
            ],
            'Namespaces' => [
                ['Organisation du code', 'Structurer avec des namespaces', 25],
                ['Autoloading PSR-4', 'Chargement automatique des classes', 30],
            ],
        ]);

        $this->createModuleWithContent($formateur, 'Base de Données SQL', 'Maîtrisez MySQL et PostgreSQL', 20000, [
            'SQL Fondamental' => [
                ['SELECT et WHERE', 'Requêtes de lecture de données', 20],
                ['JOIN', 'Combiner plusieurs tables', 35],
                ['INSERT, UPDATE, DELETE', 'Modifier les données', 25],
            ],
            'Optimisation' => [
                ['Index', 'Accélérer vos requêtes', 30],
                ['Transactions', 'Intégrité des données', 35],
            ],
        ]);

        // Give client user access to first 2 modules
        $modules = Module::take(2)->get();
        foreach ($modules as $module) {
            Purchase::create([
                'user_id' => $client->id,
                'module_id' => $module->id,
                'amount' => $module->price,
                'payment_status' => 'completed',
                'purchased_at' => now(),
            ]);

            AccessCode::create([
                'user_id' => $client->id,
                'module_id' => $module->id,
                'code' => Str::random(12),
                'expires_at' => now()->addDays(30),
            ]);
        }

        // Create sample tickets
        Ticket::create([
            'user_id' => $client->id,
            'subject' => 'Problème de connexion',
            'description' => 'Je n\'arrive pas à me connecter à mon compte',
            'status' => 'open',
        ]);

        Ticket::create([
            'user_id' => $client->id,
            'subject' => 'Question sur le cours Laravel',
            'description' => 'Comment puis-je accéder aux vidéos du chapitre 2?',
            'status' => 'closed',
        ]);
    }

    private function createModuleWithContent($user, $moduleName, $moduleDescription, $price, $chapters)
    {
        $module = Module::create([
            'name' => $moduleName,
            'description' => $moduleDescription,
            'price' => $price,
            'created_by' => $user->id,
        ]);

        $chapterOrder = 1;
        foreach ($chapters as $chapterName => $lessons) {
            $chapter = Chapter::create([
                'module_id' => $module->id,
                'name' => $chapterName,
                'description' => 'Chapitre sur ' . $chapterName,
                'order' => $chapterOrder++,
            ]);

            $lessonOrder = 1;
            foreach ($lessons as $lessonData) {
                $lesson = Lesson::create([
                    'chapter_id' => $chapter->id,
                    'name' => $lessonData[0],
                    'content' => $lessonData[1],
                    'duration' => $lessonData[2] ?? 20,
                    'order' => $lessonOrder++,
                    'video_url' => null,
                ]);

                // Add a quiz for some lessons
                if ($lessonOrder % 2 == 0) {
                    $quiz = Quiz::create([
                        'lesson_id' => $lesson->id,
                        'question' => 'Quel est le concept principal de cette leçon?',
                        'type' => 'mcq',
                        'points' => 10,
                    ]);

                    QuizOption::create([
                        'quiz_id' => $quiz->id,
                        'option_text' => 'Réponse correcte',
                        'is_correct' => true,
                    ]);

                    QuizOption::create([
                        'quiz_id' => $quiz->id,
                        'option_text' => 'Réponse incorrecte 1',
                        'is_correct' => false,
                    ]);

                    QuizOption::create([
                        'quiz_id' => $quiz->id,
                        'option_text' => 'Réponse incorrecte 2',
                        'is_correct' => false,
                    ]);
                }
            }
        }
    }
}
