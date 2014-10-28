using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;

namespace BlackJack.controller
{
    class PlayGame : IObserver<model.Card>
    {

        private model.Game a_game;
        private view.IView a_view;



        public PlayGame(model.Game game, view.IView view)
        {
            a_game = game;
            a_view = view;
        }


        public bool Play()
        {


            a_game.GetPlayer().Subscribe(this);
            a_game.GetDealer().Subscribe(this);

            RenderOut();


            if (a_game.IsGameOver())
            {
                a_view.DisplayGameOver(a_game.IsDealerWinner());
            }

            int input = a_view.GetInput();

            if (a_view.ActionNewGame(input))
            {
                a_game.NewGame();
            }
            if (a_view.ActionStand(input))
            {
                a_game.Stand();
            }
            if (a_view.ActionHit(input))
            {
                a_game.Hit();
            }

            return a_view.ActionQuit(input) == false;
        }

        public void OnNext(model.Card card)
        {
            Thread.Sleep(500);
            RenderOut();
        }

        public void RenderOut()
        {
            a_view.DisplayWelcomeMessage();

            a_view.DisplayDealerHand(a_game.GetDealerHand(), a_game.GetDealerScore());
            a_view.DisplayPlayerHand(a_game.GetPlayerHand(), a_game.GetPlayerScore());
        }

    }
}
