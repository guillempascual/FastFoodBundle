# FastFoodBundle
Bundle for managing orders in Fast Food Restaurant

It's meant to take command of the following cases:
1. **Order a Ticket** - A customer comes in the restaurant and orders her meal (ticket) . A waiter fills in the ticket  and sends it to the kitchen once done - DONE
2. **Managing tickets** A cooker can list the tickets, select one and mark the items as done - PENDING
3. **Managing products** Manager keeps the list of products updated - DONE

There are two ways in which order can be sent:

Web
==

These are the addresses to get the commands
##ticket/list
Lists all the tickets, and also allows to create new ones as well as delete them 

##ticket/new
Creates a new ticket, allowing to add as many lines as necessary

##ticket/delete
Deletes a ticket


##product/list
Lists all the products, and also allows to create new ones as well as delete them 

##product/new
Creates a new product

##product/edit
Edits a product 

##product/delete
Deletes a product 


Command Line
=========
Some limited functionality is allowed via command line.

Commands for Product
-------
      fastfood:edit-product <id> <description> <price> 
      fastfood:list-products: no parameters
      fastfood:add-film <description> <price>
      fastfood:remove-film <id>


Commands for Ticket
-------
      fastfood:list-tickets: no parameters
