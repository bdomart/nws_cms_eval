import $ from 'jquery';

// setup an "Ajouter un ingrédient" link
var $addIngredientLink = $('<a href="#" class="btn btn-secondary add_ingredient_link">Ajouter un ingrédient</a>');
var $newLinkLi = $('<li class="list-group-item"></li>').append($addIngredientLink);

$(function() {
    // Get the ul that holds the collection of ingredients
    var $collectionHolder = $('ul.ingredients');

    // add the "Ajouter un ingredient" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addIngredientLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new ingredient form (see code block below)
        addIngredientForm($collectionHolder, $newLinkLi);
    });

    setupIngredientFormDeleteLink();
});

function addIngredientForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Ajouter un ingredient" link li
    var $newFormLi = $('<li class="list-group-item"></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-ingredient text-danger">Retirer l\'ingrédient</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    setupIngredientFormDeleteLink()
}

function setupIngredientFormDeleteLink() {
    $('.remove-ingredient').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        return false;
    });
}