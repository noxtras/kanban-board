# Working with is WIP Limit #
WIP is **Work In Progress**. A work that has been started but not yet completed (acronym: WIP). In kanban, each column (_Workflow Status_) has a limit of allowed cards. It's called WIP limit.

The following posts explains how this limit forces us to be focused and keep the board running.

  * http://www.agileweboperations.com/kanban-wip-limits-the-fine-art-of-focus/
  * http://blog.crisp.se/henrikkniberg/2009/06/26/1246053060000.html

### Where is it on kanban-board? ###
![http://kanbanboard.info/public_images/kanban_WIP_limit.png](http://kanbanboard.info/public_images/kanban_WIP_limit.png)

The 2nd row of the board tells the limit of a column. You cannot (not forced yet) put more then that number of cards. As you see in image, we have 3 kinds of limits here.
  * **Fixed**: Generally, limits are simple, just a number for a column.
  * **Unlimited**: Some columns can hold unlimited cards. For example, _Backlog_ and _Done_ column.
  * **Joined**: Multiple columns shares a joined WIP limit. That means, if the joined limit of 2 column is 5, addition of these 2 columns containing cards should be at most 5.

## How to set WIP Limits? ##

![http://kanbanboard.info/public_images/kanban_workflow_status_wip.png](http://kanbanboard.info/public_images/kanban_workflow_status_wip.png)

In settings page, there is a table with list of workflow stats. This is the place where we can set the WIP limit for a status column. Setting limit is a little different for various  types of limits -
  * **Fixed**: Simple. Just click on the limit number, change it and press _Enter_. _Esc_ will leave unchanged.
  * **Unlimited**: Edit as _Fixed_ limit and set the limit to 0.
  * **Joined**: It's a bit complex. Explaining below.

### Joining Columns ###

After **WIP Limit**, The next column, **WIP Column** comes into play now. This column indicates a _WIP Limit_ will be applied on how many columns. Generally it would be 1. A single limit for a single column.
When you want to join columns(_Workflow Status_), change the value to number of columns that you want to join. An example can explain it easily -

Suppose, X, Y and Z are 3 sequential columns of our board that we want to join. So, let's go to _Workflow States_ of settigns page. First set the _WIP Limit_ of column X to the joined limit of these 3. And set the _WIP Column_ to 3 (as we are joining 3 coluns). Then, set the _WIP Column_ of other 2 columns, Y and Z to 0. Because they will not have any column for _WIP Limit_ now. These columns will share X column's limit.