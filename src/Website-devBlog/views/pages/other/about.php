<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;

$view->component('start', ['title' => $title]);
$view->component('header', $data);

?>

<main>
    <section class="section">
        <div class="container"><h1>About the Project</h1>
            <p>dev.Blog is an interactive platform that allows developers to showcase their skills, project work
                experience, education, and offers tools to manage their blog and discover new and interesting
                articles.</p>
            <h2>Main Features</h2>
            <ul>
                <li>Home Page: Contains general information about the platform, benefits of use, links to registration
                    and login for developers, several random articles.
                </li>
                <li>Registration and Authentication: Forms for creating a new account and logging into the system for
                    registered users;
                </li>
                <li>User Profile: A page with basic information about the user and a list of their articles;</li>
                <li>User Settings: A page for editing basic user information;</li>
                <li>Article: A page with the text of the article;</li>
                <li>Create Article: A form for creating a new article;</li>
                <li>Admin Panel: A page for managing users, articles, and other data;</li>
                <li>About the Project: Information about the platform, its creators, and goals.</li>
            </ul>
            <h2>Technical Requirements</h2>
            <ul>
                <li>Frontend: HTML, CSS for structure and styling, PHP for server-side data processing;</li>
                <li>Backend: PHP for processing client requests, interacting with the MySQL database;</li>
                <li>Database: MySQL for storing information about users, their projects, blog articles, and other
                    data;
                </li>
                <li>Server: OpenServer or other equivalent for local testing, hosting for deploying the site on the
                    Internet.
                </li>
            </ul>
            <h2>Implementation Steps</h2>
            <ol>
                <li>Database Structure Design: Define tables for storing information about users, projects, articles,
                    and other data.
                </li>
                <li>Frontend Development: Create the HTML structure for each page, apply CSS for styling.</li>
                <li>Backend Implementation: Write PHP scripts to process forms, interact with the database, and
                    authenticate users.
                </li>
                <li>Testing: Verify the correctness of all website components, fix any discovered bugs.</li>
                <li>Deployment: Deploy the site on the server.</li>
            </ol>
            <p>This idea not only demonstrates your skills as a developer but also provides a useful resource for other
                developers interested in your experience and knowledge.</p>
            <h2>Conclusion</h2>
            <p>dev.Blog is an excellent way to share your knowledge and experience with other developers, as well as
                receive feedback and support from the community. Start creating your blog now and become part of our
                community!</p>
            <h2>Author</h2>
            <p>dev.Blog is the first web project in PHP created by <a href="https://github.com/ShutovKS">Kirill
                    Shutov</a> in 2024.</p>
            <p>If you have any questions or suggestions, please contact me by email: <a href="mailto:i@shutovks.ru">email</a>
            </p>
            <h2>License</h2>
            <p>This project is licensed under the MIT license.</p>
        </div>
    </section>
</main>

<?php
$view->component('footer');
$view->component('end');
?>
