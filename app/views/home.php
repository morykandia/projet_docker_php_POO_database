
    <h1>TOUS LES POSTS</h1>

    <?php
    /** @var App\Entity\Post[] $posts */
    foreach ($posts as $post) {
        echo $post->getContent();
    }


