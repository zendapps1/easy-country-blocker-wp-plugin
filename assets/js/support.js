    FreshworksWidget('identify', 'ticketForm', {
        name: ecb_support.name,
        subject: ecb_support.subject,
        email:  ecb_support.email, 
        type: 'Easy Country Blocker',
    });

    FreshworksWidget('hide', 'ticketForm', ['name', 'subject', 'type', 'priority']);




