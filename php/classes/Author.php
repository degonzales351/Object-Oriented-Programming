<?php
namespace dgonzales351\DataDesign;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Cross Section of an Authors Profile
 *
 * This is a cross section of what is probably stored about an Mac user. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Profile).
 *
 * @author Daniel Gonzales <dgonzales351@cnm.edu>
 * @version 4.0.0
 **/
class Author  {
	use ValidateUuid;
	/**
	 * id for this Author; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * at handle for this Author; this is a unique index
	 * @var string $authorId
	 **/
	private $authorActivationToken;
	/**
	 * token handed out to verify that the Author is valid and not malicious.
	 *v@var $authorActivationToken
	 **/
	private $authorAvatarUrl;
	/**
	 * email for this Author; this is a unique index
	 * @var string $authorAvatarUrl
	 **/
	private $authorEmail;
	/**
	 * hash for author password
	 * @var $authorEmail
	 **/
	private $authorHash;
	/**
	 * hash number for this new Author
	 * @var string $authorHash
	 **/
	private $authorUsername;
	/**
	 * author Username
	 *
	 * @var $authorUsername
	 */
private $AuthorId;

	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id (or null if new Author)
	 **/
	public function AuthorId(): Uuid {
		return ($this->authorId());
	}
	/**
	 * mutator method for author id
	 *
	 * @param  Uuid| string $authorId value of new profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profile Id is not
	 **/
	public function __construct($newAuthorId, $newAuthorUsername, string $newAuthorEmail, $newauthorHash = null) {
		try {
			$this->setProfileActivationToken($newAuthorId);
			$this->setAuthorUsername($newAuthorUsername);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setauthorHash($newauthorHash);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function setProfileId( $authorId): void {
		try {
			$uuid = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	public function getauthorActivationToken() : ?string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setProfileActivationToken(?string $newAuthorActivationToken): void {
		if($newAuthorActivationToken === null) {
			$this->AuthorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for at handle
	 *
	 * @return string value of at handle
	 **/
	public function getProfileAtHandle(): string {
		return ($this->authorAvatarUrl);
	}
	/**
	 * mutator method for at handle
	 *
	 * @param string $newAuthorAtHandle new value of at handle
	 * @throws \InvalidArgumentException if $newAuthorAtHandle is not a string or insecure
	 * @throws \RangeException if $newAuthorAtHandle is > 32 characters
	 * @throws \TypeError if $newAuthorAtHandle is not a string
	 **/
	public function setAuthorUsername(string $newAuthorUsername) : void {
		// verify the at handle is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("authors username is empty or insecure"));
		}
		// verify the at handle will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("authors username is too large"));
		}
		// store the at handle
		$this->AuthorUsername = $newAuthorUsername;
	}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getProfileEmail(): string {
		return $this->authorEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newAuthorEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setAuthorEmail(string $newAuthorEmail): void {
		// verify the email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("author email is too large"));
		}
		// store the email
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 */
	/**
	 * @return mixed
	 */
	public function getAuthorHash() {
		return $this->authorHash;
	}

	/**
	 * mutator method for author hash password
	 *
	 * @param string $authorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setauthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$profileHashInfo = password_get_info($newAuthorHash);
		if($profileHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("author hash must be 97 characters"));
		}
		//store the hash
		$this->profileHash = $newAuthorHash;
	}
	/**
	 * accessor method for author
	 *
	 * @return string value of author or null
	 **/
	public function getAuthorUsername(): ?string {
		return ($this->authorUsername);
	}
	/**
	 * mutator method for author
	 *
	 * @param string $authorUsername new value of author
	 * @throws \InvalidArgumentException if $newAuthor is not a string or insecure
	 * @throws \RangeException if $newAuthor is > 32 characters
	 * @throws \TypeError if $newAuthor is not a string
	 **/
	public function authorUsername(?string $authorUsername): void {
		//if $authorUsername is null return it right away
		if($authorUsername === null) {
			$this->authorUsername = null;
		}
		// verify the author username is secure
		$authorUsername = trim($authorUsername);
		$authorUsername = filter_var($authorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($authorUsername) === true) {
			throw(new \InvalidArgumentException("Authors username is empty or insecure"));
		}
		// verify the author username will fit in the database
		if(strlen($authorUsername) > 32) {
			throw(new \RangeException("Authors username is too long"));
		}
		// store the authors username
		$this->authorEmail = $authorUsername;
	}
}




