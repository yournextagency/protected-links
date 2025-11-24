<?php
/**
 * Protected Links plugin for Craft CMS 4.x and 5.x
 *
 * Secure & restricted files download
 *
 * @link      http://www.intoeetive.com/
 * @copyright Copyright (c) 2018 Yurii Salimovskyi
 */

namespace yournextagency\protectedlinks\models;

use yournextagency\protectedlinks\ProtectedLinks;

use Craft;
use craft\base\Model;

/**
 * Link Model
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Yurii Salimovskyi
 * @package   ProtectedLinks
 * @since     0.0.1
 */
class Link extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var int Site ID
     */
    public int $siteId = 1;

    /**
     * @var int Asset ID
     */
    public int $assetId = 0;

    /**
     * @var string Link checksum
     */
    public string $checksum = '';

    /**
     * @var int Deny hotlink flag
     */
    public int $denyHotlink = 0;

    /**
     * @var int Require login flag
     */
    public int $requireLogin = 0;

    /**
     * @var string Serialized member groups
     */
    public string $memberGroups = '';

    /**
     * @var string Serialized members
     */
    public string $members = '';

    /**
     * @var int Display inline flag
     */
    public int $inline = 0;

    /**
     * @var string|int MIME type
     */
    public string|int $mimeType = 0;

    /**
     * @var string|null Expiration date
     */
    public ?string $dateExpires = null;

    /**
     * @var int Download counter
     */
    public int $downloads = 0;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            ['assetId', 'integer']
        ];
    }
}
