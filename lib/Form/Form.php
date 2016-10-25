<?php
namespace Tit\lib\Form;


use Tit\lib\Entity\Hydratable;

/**
 * Class Form
 * @package Tit\lib\Form
 */
class Form{

    use Hydratable;

    /**
     * Fields of the form.
     * Array of fields.
     * @var array
     */
    protected $fields;

    /**
     * Messages of the form.
     * It's an associative array.
     * @var array
     */
    protected $messages;

    /**
     * Is true if the form is filled by the builder.
     * @var bool
     */
    protected $isFilled;

    /**
     * Form constructor.
     * @param array $data
     */
    public function __construct(array $data = array()){
        $this->fields = array();
        $this->messages = array();
        $this->isFilled = false;

        $this->hydrate($data);
    }

    /**
     * Add a field to the form.
     * @param Field $field
     * @return Form
     */
    public function addField(Field $field){
    // For php7.1 public function addField(Field $field): Form{
            $this->fields[$field->name()] = $field;
        return $this;
    }

    /**
     * Remove all field then add multiple fields to the form.
     * @param array $fields
     * @return Form
     */
    public function setFields(array $fields){
    // For php7.1 public function setFields(array $fields): Form{
            $this->fields = array();
        foreach((array) $fields as $field)
            if ($field instanceof Field)
                $this->addField($field);

        return $this;
    }

    /**
     * Remove field with name $name.
     * @param string $name
     * @return Form
     */
    public function removeField(string $name){
    // For php7.1 public function removeField(string $name): Form{
            unset($this->fields[$name]);
        return $this;
    }

    /**
     * Remove all fields.
     * @return Form
     */
    public function removeAllFields(){
    // For php7.1 public function removeAllFields(): Form{
            $this->fields = array();
        return $this;
    }

    /**
     * Getter
     * @param string $name
     * @return null|Field
     */
    public function field(string $name){
    // For php7.1 public function field(string $name): ?Field{
            return $this->fields[$name] ?? null;
    }

    /**
     * Getter
     * @return array
     */
    public function fields(){ return $this->fields; }
    // For php7.1 public function fields(): array{ return $this->fields; }

    /**
     * Add message to the form.
     * @param string $name
     * @param string $message
     * @return Form
     */
    public function addMessage(string $name, string $message){
    // For php7.1 public function addMessage(string $name, string $message): Form{
            $this->messages[$name] = $message;
        return $this;
    }

    /**
     * Remove all messages then add multiple messages to the form.
     * @param array $msg
     * @return Form
     */
    public function setMessages(array $msg){
    // For php7.1 public function setMessages(array $msg): Form{
            $this->messages = $msg;

        return $this;
    }

    /**
     * Remove message with name $name.
     * @param string $name
     * @return Form
     */
    public function removeMessage(string $name){
    // For php7.1 public function removeMessage(string $name): Form{
            unset($this->messages[$name]);
        return $this;
    }

    /**
     * Remove all message.
     * @return Form
     */
    public function removeAllMessages(){
    // For php7.1 public function removeAllMessages(): Form{
            $this->messages = array();
        return $this;
    }

    /**
     * Getter
     * @param string $name
     * @return null|string
     */
    public function message(string $name){
    // For php7.1 public function message(string $name): ?string{
            return $this->messages[$name] ?? null;
    }

    /**
     * Getter
     * @return array
     */
    public function messages(){ return $this->messages; }
    // For php7.1 public function messages(): array{ return $this->messages; }

    /**
     * Getter
     * @return bool
     */
    public function isFilled(){
    // For php7.1 public function isFilled(): bool{
            return $this->isFilled;
    }

    /**
     * Set isFilled to true.
     * @return Form
     */
    public function filled(){
    // For php7.1 public function filled(): Form{
            $this->isFilled = true;
        return $this;
    }

    /**
     * Set isFilled to false.
     * @return Form
     */
    public function unfilled(){
    // For php7.1 public function unfilled(): Form{
            $this->isFilled = false;
        return $this;
    }

    /**
     * toggle isFilled.
     * @return Form
     */
    public function toggleFilled(){
    // For php7.1 public function toggleFilled(): Form{
            $this->isFilled = !$this->isFilled;
        return $this;
    }
}
