<?php
namespace MyApp\Models;

/**
 * Class Comments
 * @package MyApp\Models
 */
class Comments extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|FALSE|int
     */
    public function getCommentsList()
    {
        return $this->db->exec('SELECT * FROM comments ORDER BY created DESC');
    }

    /**
     * @param string $author
     * @param string $content
     * @param string $ip
     * @return bool
     */
    public function saveNewComment($author, $content, $ip)
    {
        $sql = "
            INSERT INTO comments (`author`, `content`, `ip`)
            VALUES (?, ?, ?)
        ";

        return $this->db->exec($sql, [$author, $content, $ip]);
    }
}