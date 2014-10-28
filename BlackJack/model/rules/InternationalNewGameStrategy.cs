using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack.model.rules
{
    class InternationalNewGameStrategy : INewGameStrategy
    {

        public bool NewGame(Dealer a_dealer, Player a_player)
        {
            a_dealer.NewCard(true, a_player);

            a_dealer.NewCard(true, a_dealer);

            a_dealer.NewCard(true, a_player);

            return true;
        }
    }
}
