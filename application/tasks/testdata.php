<?php

use \Laravel\Database;

use \ch\aeberhardo\dao\UserDAO;
use \ch\aeberhardo\dao\impl\UserDAOImpl;
use \ch\aeberhardo\dao\BookmarkDAO;
use \ch\aeberhardo\dao\impl\BookmarkDAOImpl;
use \ch\aeberhardo\dao\TagDAO;
use \ch\aeberhardo\dao\impl\TagDAOImpl;

class Testdata_Task {

    
    /**
     * @var UserDAO 
     */
    private $userDAO;
    
    /**
     * @var BookmarkDAO 
     */
    private $bookmarkDAO;

    /**
     * @var TagDAO 
     */
    private $tagDAO;
    
    public function __construct() {
        $this->userDAO = new UserDAOImpl();
        $this->bookmarkDAO = new BookmarkDAOImpl();
        $this->tagDAO = new TagDAOImpl();
    }

    public function run($arguments) {
        echo "\n";
        echo "# Availabe goals\n";
        echo "\n";
        echo "testdata:insert    Inserts test data into database.\n";
        echo "testdata:delelte   Deletes test data from database.";
    }

    public function insert() {
        echo "\ninserting test data ... ";

        Database::transaction(function() {
            
                    $user = $this->insertUser('johndoe', 'john.doe@example.com', 'john');
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.google.ch', 'Google', 'Google Description', array('search', 'google'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.amazon.ch', 'Amazon', 'Amazon Description', array('shop'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.bing.com', 'Bing', 'Bing Description', array('search'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.stackoverflow.com', 'Stack Overflow', 'Stack Overflow is a programming Q & A site that\'s free. Free to ask questions, free to answer questions, free to read, free to index, built with plain old HTML, no fake rot13 text on the home page, no scammy google-cloaking tactics, no salespeople, no JavaScript windows dropping down in front of the answer asking for $12.95 to go away. You can register if you want to collect karma and win valuable flair that will appear next to your name, but otherwise, it\'s just free. And fast. Very, very fast.', array('code', 'forum', 'java', 'php'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.laravel.com', 'Laravel', 'Laravel is a clean and classy framework for PHP web development. Freeing you from spaghetti code, Laravel helps you create wonderful applications using simple, expressive syntax.', array('code', 'php'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.php.net', 'PHP.net', 'PHP is a widely-used general-purpose scripting language that is especially suited for Web development and can be embedded into HTML.', array('code', 'php'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.netbeans.org', 'NetBeans', null, array('code', 'tool'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.eclipse.org', 'Eclipse', 'Eclipse Description', array('code', 'tool'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.cygwin.com', 'Cygwin', 'A collection of tools which provide a Linux look and feel environment for Windows.', array('tool', 'code'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.apachefriends.org/en/index.html', 'XAMPP', 'XAMPP is an easy to install Apache distribution containing MySQL, PHP and Perl. XAMPP is really very easy to install and to use - just download, extract and start.', array('tool', 'php', 'sql'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.github.com', 'github', 'github Description');
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.lifehacker.com', 'Lifehacker', 'Lifehacker Description');
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.gametrailers.com', 'GameTrailers', 'GameTrailers Description');
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.mysql.com', 'MySQL', 'MySQL Description', array('code', 'sql'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://en.wikipedia.org', 'Wikipedia', 'Wikipedia Description');
                    $this->insertBookmarkAndTagsForUser($user, 'http://git-scm.com', 'Git', 'Git Description', array('code'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.microsoft.ch', 'Microsoft', 'Microsoft Description', array('software'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.apple.com', 'Apple', 'Apple Description', array('hardware', 'software'));

                    
                    $user = $this->insertUser('janedoe', 'jane.doe@example.com', 'jane');
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.coop.ch', 'Coop', 'Coop Description', array('food', 'swiss', 'shop'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.migros.ch', 'Migros', 'Migros Description', array('food', 'swiss', 'shop'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://notepad-plus-plus.org', 'Notepad++', 'Notepad++ is a free source code editor and Notepad replacement that supports several languages. Running in the MS Windows environment, its use is governed by GPL License.', array('tool', 'open source'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.imdb.com', 'IMDb', 'Movies, TV and Celebrities', array('movie'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.srf.ch', 'Schweizer Radio und Fernsehen', '', array('movie', 'swiss'));
                    $this->insertBookmarkAndTagsForUser($user, 'http://www.landi.ch', 'Landi', 'Landi Description', array('food', 'swiss', 'shop'));
                    
                });

        echo 'done!';
    }

    public function delete() {
        echo "\ndeleting test data ... ";

        Database::table('users')->delete();

        echo 'done!';
    }

    private function insertBookmarkAndTagsForUser(User $user, $url, $title, $description, array $tags = array()) {
        $bookmark = static::createBookmark($url, $title, $description);
        $this->bookmarkDAO->saveForUser($user, $bookmark);

        foreach ($tags as $tag) {
            $tagModel = static::createTag($tag);
            $this->tagDAO->saveForBookmark($tagModel, $bookmark);
        }
    }

    /**
     * @return Bookmark
     */
    private static function createBookmark($url, $title, $description) {
        $bookmark = new Bookmark();
        $bookmark->url = $url;
        $bookmark->title = $title;
        $bookmark->description = $description;
        return $bookmark;
    }

    /**
     * @return Tag
     */
    private static function createTag($name) {
        $tag = new Tag();
        $tag->name = $name;
        return $tag;
    }

    
    private function insertUser($username, $email, $password) {
        $user = static::createUser($username, $email, $password);
        $this->userDAO->save($user);
        return $user;
    }
    
    /**
     * @return User
     */
    private static function createUser($username, $email, $password) {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = Laravel\Hash::make($password);
        return $user;
    }

}

